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
                        <li>
                            <a class="scrollTo" href="#showcase">Showcase</a>
                        </li>                    
                        <li>
                            <a class="scrollTo" href="#contact">Contact</a>
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
                                // echo '
                                //     <li>
                                //         <a href="./login">'.$_SESSION['user_name'].'</a>
                                //     </li>';      
                                //<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                //                        <img src="' . $login->user_gravatar_image_url . '" alt="Alternate Text" class="img-responsive" />
                                //                    </div>                                      
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
    <div class="slide-content" id="showcase">
        <div class="container">                      
            <div class='row row-top'> 
                 <!-- START THE FEATURETTES -->

                <div class="row featurette">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-feature">
                        <h2 class="featurette-heading">Masterpiece <span class="text-muted"></span></h2>
                        <p class="lead">A Sunday on La Grande Jatte (1884) - Georges Seurat</p>
                        <a href="https://photoplus.app/editor/KfC3k" class="btn btn-start" target="_blank">View Project</a>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 iframe-wrap" style="height:500px;">
                        <div class="cover-link"></div>
                        <iframe style="width:100%; height:500px;" frameborder="0" sandbox="allow-scripts allow-pointer-lock allow-same-origin" 
                                data-src="https://photoplus.app/editor/view-project-static.php?uid=KfC3k" scrolling="no"
                                allowtransparency="true" data-title="" data-slug-hash="KfC3k" 
                                src="https://photoplus.app/editor/view-project-static.php?uid=KfC3k" ></iframe>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 iframe-wrap" style="height:500px;">
                        <div class="cover-link"></div>
                        <iframe style="width:100%; height:500px;" frameborder="0" sandbox="allow-scripts allow-pointer-lock allow-same-origin" 
                                data-src="https://photoplus.app/editor/view-project-static.php?uid=G8ls9" scrolling="no"
                                allowtransparency="true" data-title="" data-slug-hash="G8ls9" 
                                src="https://photoplus.app/editor/view-project-static.php?uid=G8ls9" ></iframe>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-feature">
                        <h2 class="featurette-heading">Space - The final frontier <span class="text-muted"></span></h2>
                        <p class="lead">Messier 81 ( also known as NGC 3031 or Bode's Galaxy )</p>
                        <a href="https://photoplus.app/editor/G8ls9" class="btn btn-start" target="_blank">View Project</a>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-feature">
                        <h2 class="featurette-heading">Infographic <span class="text-muted"></span></h2>
                        <p class="lead">iA's Web Trend Map ( based on Tokyo Metro System )</p>
                        <a href="https://photoplus.app/editor/On5pQ" class="btn btn-start" target="_blank">View Project</a>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 iframe-wrap" style="height:500px;">
                        <div class="cover-link"></div>
                        <iframe style="width:100%; height:500px;" frameborder="0" sandbox="allow-scripts allow-pointer-lock allow-same-origin" 
                                data-src="https://photoplus.app/editor/view-project-static.php?uid=On5pQ" scrolling="no"
                                allowtransparency="true" data-title="" data-slug-hash="On5pQ" 
                                src="https://photoplus.app/editor/view-project-static.php?uid=On5pQ" ></iframe>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <div class="main-content" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3"></div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="text-center"><h2>Get in touch with us</h2></div>
                    <form  role="form" action="contact/index.php"  method="post" id="contact-form">
                        <div class="form-group">
                            <span class="filler">Hello,<br/>My </span>
                            <label for="name" class="label-field">name</label>
                            <span class="filler"> is </span>
                            <input type="text" name="name" class="input-field" id="name" placeholder="your name here"/>

                            <span class="filler"> and my </span>
                            <label for="email" class="label-field">email address</label>
                            <span class="filler"> is </span>
                            <input type="email" name="email" class="input-field" id="email" placeholder="your email address" />
                            <br>
                            <span class="filler">I'd like to send you a </span>
                            <label for="message" class="label-field">message</label>
                            <span class="filler">  regarding... </span><br/>
                            <textarea name="message" rows="4" class="input-field" style="width:100%;" id="message" placeholder="Enter your message here"></textarea>
                        </div>
                    <button type="submit" id="submit" class="btn inverted-btn-white btn-lg btn-block">Submit</button>
                </form>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3"></div>
            </div>
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
        var frm = $("#contact-form");
        frm.submit(function(ev) {            
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                dataType: "json",
                data: frm.find('input, textarea').serialize() + "&contact=1",
                success: function(data) {
                    if(data.success) {
                        $('.top-right').notify({
                            message : {
                                text : data.message
                            },
                            type : 'success',
                            fadeOut : {
                                delay: Math.floor(Math.random() * 500) + 2500
                            }
                        }).show(); 
                        frm.reset();       
                    } else {
                        $('.top-right').notify({
                            message : {
                                text : data.message
                            },
                            type : 'danger',
                            fadeOut : {
                                delay: Math.floor(Math.random() * 500) + 2500
                            }
                        }).show();
                    }            
                },
                error: function(data) {
                    $('.top-right').notify({
                        message : {
                            text : data.message
                        },
                        type : 'danger',
                        fadeOut : {
                            delay: Math.floor(Math.random() * 500) + 2500
                        }
                    }).show();
                }
            });
            ev.preventDefault();
        });
    });
	</script>
    </body>
</html>
