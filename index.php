<?php     
    require_once("login/config/config.php");
    require_once('login/classes/Login.php');    
    error_reporting(0);
    $login = new Login();
?>
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
        <link rel="icon" href="img/logo.png">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-social.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">        
        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body data-spy="scroll">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class='notifications top-right'></div>
        <header class="navbar navbar-default navbar-fixed-top shadow" id="mainHeader">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars"></span>
                    </button>
                <a class="navbar-brand" href="https://photoplus.app">PhotoPlus</a>
                </div>
                <div class="navbar-collapse collapse navbar-scroll">
                    <ul class="nav navbar-nav navbar-right">            
                        <li>
                            <a class="scrollTo" href="#home">Home</a>
                        </li>
                        <?php
                            if ($login->isUserLoggedIn() == false) {
                                echo '  
                                <li>
                                    <a href="./login">Login</a>
                                </li>
                                <li>
                                    <a class="" href="./login/register.php">Sign Up</a>
                                </li>';
                            }
                            else {
                                echo '<li>
                                        <a href="#" id="drop" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop">                                        
                                            <li role="presentation"><a href="./login" class=""><img src="' . $login->user_gravatar_image_url . '" alt="Alternate Text" id="profile-pic"/> '.$_SESSION['user_name'].'</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a href="./login/edit.php" class="">Settings</a></li>
                                            <li role="presentation"><a href="index.php?logout" class="">Sign Out</a></li>
                                        </ul>
                                    </li>';
                            }
                        ?>
                    </ul>          
                </div><!--/.navbar-collapse -->
            </div>
        </header>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" id="home">
        <div class="container">
            <p class="text-center title-info" style="margin-top: 10px;"><img class="logo-picture" src="img/logo-alt.png" alt="PhotoPlus"/></p>
            <h2 class="text-center">Do more with your image</h2>
            <p class="text-center title-info message">PhotoPlus is a open-source platform which transforms every <br/> ordinary image in a new extraordinary experience</p>            
            <p class="text-center"><a href="./editor" class="btn btn-lg inverted-btn-white">Start now<i class="fa fa-chevron-right fa-fw"></i></a></p>       
        </div>
    </div>
    <footer class="footer-content"> 
        <div class="container">
            
            <div class="row row-top">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                    <!-- <p> Tweet us at <a target="_blank" style="color:#1abc9c" href="https://twitter.com/photoplusapp">@photoplusapp</a>&nbsp;&nbsp;&nbsp;&nbsp;Email us at <span style="color:#1abc9c;">office@photoplus.app</span></p> -->
                    <ul class="social-links text-center">
                        <li><a href="https://twitter.com" class="twitter-link"><i class="fa fa-twitter fa-fw"></i></a></li>
                        <li><a href="https://facebook.com" class="facebook-link"><i class="fa fa-facebook fa-fw"></i></a></li>
                        <li><a href="https://plus.google.com/" class="googleplus-link"><i class="fa fa-google-plus fa-fw"></i></a></li>                                                
                        <li><a href="https://www.pinterest.com/" class="pinterest-link"><i class="fa fa-pinterest fa-fw"></i></a></li>
                    </ul>
                </div>
            </div>            
        </div>
    </footer>
    <a href="#" class="btn back-to-top btn-to-top-light btn-to-top-bottom" data-toggle="tooltip" data-placement="top" title="top"> <span class="fa fa-chevron-up"></span> </a> 
    <script type="text/javascript" src="js/vendor/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="js/prefixfree.min.js"></script>    
    <script type="text/javascript" src="js/plugins.js"></script>	
    <script type="text/javascript" src="js/nicescroll.min.js"></script>	
    <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript">    
	$(document).ready(function() {
	    $("html").niceScroll({cursorcolor:"#333",cursoropacitymax:0.6,cursorwidth:10});        
	</script>
    </body>
</html>
