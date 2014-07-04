<?php
    require_once("../login/config/config.php");     
    $json = array(
        'success' => false,
        'message' => ""
    );
    if(isset($_POST['update'])) {
        try {
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);        

            $title = htmlentities($_POST['title']);
            $description = htmlentities($_POST['description']);			
            $uniqueId = htmlentities($_POST['uniqueId']);
            $query_update = $dbConnection->prepare("UPDATE project SET title = :title, description = :description WHERE unique_id = :uniqueId");
            $query_update->bindValue(':title', $title, PDO::PARAM_STR);
            $query_update->bindValue(':description', $description, PDO::PARAM_STR);
            $query_update->bindValue(':uniqueId', $uniqueId, PDO::PARAM_STR);
            $query_update->execute();
            if ($query_update->rowCount()) {
                    $json['success'] = true;
                    $json['message'] = "Project updated";
                    echo json_encode($json);
            } else {
                $json['message'] = "Project query failed";
                echo json_encode($json);
            }            
        } catch(PDOException $e) {
            echo 'Database error'.$e->getMessage();        
        }     
    }    
	else {
		//echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Project update failed.</div>";
		$json['message'] = "Not set update";
        echo json_encode($json);
	}
?>