<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }    
    require_once("../login/config/config.php");	
    require_once('../login/classes/Login.php');    
    error_reporting(0);
    $login = new Login();
    
    $get_info = false;    
    $authorId;
    if(isset($_GET['uid'])) {   
        $get_info = true;     
        try {
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);
            $uniqueId = htmlentities($_GET['uid']);        
            $query_select = $dbConnection->prepare("SELECT * FROM project WHERE unique_id = :uniqueId");
            $query_select->bindValue(':uniqueId', $uniqueId, PDO::PARAM_STR);
            $query_select->execute();
            if ($query_select->rowCount()) {                
                $result_row = $query_select->fetch(PDO::FETCH_ASSOC);
                $title = $result_row['title'];
                $description = $result_row['description'];
                $fileImage = $result_row['file_image'];
                $fileGeoJson = $result_row['file_geojson'];
				$authorId = $result_row['author_id'];                 
            }
            $dbConnection = null;            
        } catch(PDOException $e){
            echo 'Database error'.$e->getMessage();        
        }
    }   
	if ($get_info) { 
        try {
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);
            $query_social = $dbConnection->prepare("SELECT user_name, user_email, user_twitter, user_facebook, user_googleplus FROM users WHERE user_id = :userId");
            $query_social->bindValue(":userId", $authorId, PDO::PARAM_INT);
            $query_social->execute();
            if($query_social->rowCount()) {
                $result_row = $query_social->fetch(PDO::FETCH_ASSOC);
                $name = $result_row['user_name'];
                $email = $result_row['user_email'];
                $twitter = $result_row['user_twitter'];
                $facebook = $result_row['user_facebook'];
                $googleplus = $result_row['user_googleplus'];
            }
            $dbConnection = null;            
        } catch(PDOException $e){
            echo 'Database error'.$e->getMessage();        
        }
        if(($login->isUserLoggedIn() == true ) && ($_SESSION['user_id'] === $authorId)) {
            include ("update-project.php"); 
        }  
        else {            
            include("view-project.php");
        }
	} 
	else { 				
		include("create-project.php");
	} 
?>