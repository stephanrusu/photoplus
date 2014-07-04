<?php 	
    require_once("../login/config/config.php");
    function randomString() {
        $character_set_array = array();
        $character_set_array[] = array('count' => 5, 'characters' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');        
        $temp_array = array();
        foreach ($character_set_array as $character_set) {
            for ($i = 0; $i < $character_set['count']; $i++) {
                $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
            }
        }
        shuffle($temp_array);
        return implode('', $temp_array);
    }    
	
	$json = array(
		'success' => false,
        'message' => '',
		'uid'	  => ''
	);
    if(isset($_POST['save'])){
        try {
            # create connection
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);        
        
            $title = htmlentities($_POST['title']);
            $description = htmlentities($_POST['description']);
			$fileImage = htmlentities($_POST['fileImage']);
            
            $temp = explode(".", $fileImage);
		    $fileGeoJson = $temp[0].".json";        

			$authorId = htmlentities($_POST['authorId']);
            $uniqueId = randomString();

            $query_new_user_insert = $dbConnection->prepare("INSERT INTO project (title, description, file_image, file_geojson, author_id, unique_id) VALUES (:title, :description, :fileImage, :fileGeoJson, :authorId, :uniqueId)");
            $query_new_user_insert->bindValue(':title', $title, PDO::PARAM_STR);
            $query_new_user_insert->bindValue(':description', $description, PDO::PARAM_STR);
            $query_new_user_insert->bindValue(':fileImage', $fileImage, PDO::PARAM_STR);
            $query_new_user_insert->bindValue(':fileGeoJson', $fileGeoJson, PDO::PARAM_STR);
            $query_new_user_insert->bindValue(':authorId', $authorId, PDO::PARAM_INT);
            $query_new_user_insert->bindValue(':uniqueId', $uniqueId, PDO::PARAM_STR);
            $query_new_user_insert->execute();
            if ($query_new_user_insert->rowCount()) {
				$json['success'] = true;                
				$json['uid'] = $uniqueId;
				echo json_encode($json);
            } else {                
                $json['message'] = "Project save error";
				echo json_encode($json);
            }            
            # close the connection
            $dbConnection = null;       
        } catch(PDOException $e){
            $json['message'] = 'Database error'.$e->getMessage();
            echo json_encode($json);
        } 
    }
	else {		
        $json['message'] = "Not set save";
		echo json_encode($json);
	}
?>