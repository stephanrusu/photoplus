<?php 
    require_once("../login/config/config.php");     
    $json = array(
        'success' => false,
        'message' => ""
    );
    function deleteDirectory($dir) {
        $iterator = new RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $filename => $fileInfo) {
            if ($fileInfo->isDir()) {
                rmdir($filename);
            } else {
                unlink($filename);
            }
        }
    }

    if(isset($_POST['delete'])) {
        try {
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);                

            $uniqueId = htmlentities($_POST['uniqueId']);
            $query_delete_dir = $dbConnection->prepare("SELECT file_image  FROM project WHERE unique_id = :uniqueID");
            $query_delete_dir->bindValue(":uniqueID", $uniqueId, PDO::PARAM_STR);
            $query_delete_dir->execute();
            $result_row = $query_delete_dir->fetchObject();

            $delete_dir = explode(".", $result_row->file_image);
            unlink("server/php/".$delete_dir[0].".json");
            unlink("server/php/files/".$result_row->file_image);
            unlink("server/php/files/thumbnail/".$result_row->file_image);
            deleteDirectory("server/php/".$delete_dir[0]);
            rmdir("server/php/".$delete_dir[0]);            
            // $json['success'] = true;
            // $json['message'] = $result_row->file_image;
            // echo json_encode($json);                    
            $query_delete_pro = $dbConnection->prepare("DELETE FROM project WHERE unique_id = :uniqueID");
            $query_delete_pro->bindValue(":uniqueID", $uniqueId, PDO::PARAM_STR);
            $query_delete_pro->execute();
            if ($query_delete_pro->rowCount()) {                
                $json['success'] = true;
                $json['message'] = "Project deleted";
                echo json_encode($json);
                $dbConnection = null;                
            } else {
                $json['message'] = 'Project delete failed';
                echo json_encode($json);
                $dbConnection = null;
            }                        
        } catch(PDOException $e){
                echo 'Database error'.$e->getMessage();
        }
    }    
    else {
        $json['message'] = "Not set delete";
        echo json_encode($json);
    }
?>