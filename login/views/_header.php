<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Photoplus</title>
        <meta name="description" content="">
        <link rel="icon" href="../img/logo.png">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-social.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">        

        <script type="text/javascript" src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body> 
        <div class='notifications top-right'></div>
        <header class="navbar navbar-default navbar-static shadow" style="margin-bottom:0px;">
            <div class="container">
                 <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars"></span>
                    </button>
                <a class="navbar-brand" href="https://photoplus.app">PhotoPlus</a>
                </div>
                <div class="navbar-collapse collapse">                    
                    <a href="../editor" class="btn inverted-btn-white  pull-right" style=" margin: 9px 0; color: #1abc9c; border: 0px;">Create new project</a>
                </div><!--/.navbar-collapse -->
            </div>
        </header> 
        <div class="user-content">     
    <?php
    // show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            foreach ($login->errors as $error) {                
                echo '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="text-center">'.$error.'</p>
                     </div>';

            }
        }
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo '<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="text-center">'.$message.'</p>
                     </div>';
            }
        }
    }
    // show potential errors / feedback (from registration object)
    if (isset($registration)) {
        if ($registration->errors) {
            foreach ($registration->errors as $error) {
                echo '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="text-center">'.$error.'</p>
                     </div>';
            }
        }
        if ($registration->messages) {
            foreach ($registration->messages as $message) {
                echo '<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="text-center">'.$message.'</p>
                     </div>';
            }
        }
    }
    ?>
