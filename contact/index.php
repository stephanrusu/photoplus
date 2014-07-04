<?php
    require_once("../login/config/config.php");  
    require_once('../login/libraries/PHPMailer.php');   

    $json = array(
        'success' => false,
        'message' => "",
    );
    if(isset($_POST['contact'])) { 
        $userName =  htmlentities($_POST['name']);
        $userEmail = htmlentities($_POST['email']);
        $userMessage = htmlentities($_POST['message']);

        $mail = new PHPMailer();
        $mail->IsMail();
        $mail->From = $userEmail;
        $mail->FromName = $userName;
        $mail->AddAddress("stefan.rusu@live.com","Stefan");
        $mail->Subject = "Message from Photoplus";
        $mail->Body = $userMessage;
        if(!$mail->Send()) {
            $json['message'] = $mail->ErrorInfo;
            echo json_encode($json);
        } else {
            $json['success'] = true;
            $json['message'] = "Email sent";
            echo json_encode($json);
        }
    }    
	else {
		//echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Project update failed.</div>";
		$json['message'] = "Not set subscribe";
        echo json_encode($json);
	}	
?>