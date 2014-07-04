<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Editor - Photoplus</title>
        <meta name="description" content="">
        <link rel="icon" href="../img/logo.png">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-social.css" />
        <link rel="stylesheet" type="text/css" href="../css/main.css" />        
        <link rel="stylesheet" type="text/css" href="css/bootstrap-plugins.css" />
        <link rel="stylesheet" type="text/css" href="css/leaflet.css" />
        <link rel="stylesheet" type="text/css" href="css/leaflet.draw.css" /> 
        <link rel="stylesheet" type="text/css" href="css/leaflet.plugins.css" /> 
        <link rel="stylesheet" type="text/css" href="css/jquery.fileupload.plugins.css" />        
        <link rel="stylesheet" type="text/css" href="css/preloader.css" />                		
        <script type="text/javascript" src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <style type="text/css">     
            #leafletmap { height: 100%; }
			.modal-static { 
				position: fixed;
				top: 50% !important; 
				left: 50% !important; 
				margin-top: -100px;  
				margin-left: -100px; 
				overflow: visible !important;
			}
			.modal-body {
				padding: 0;                             
			}
			.modal-static,
			.modal-static .modal-dialog,
			.modal-static .modal-content {
				width: 200px; 
				height: 200px; 
			}
			.modal-static .modal-dialog,
			.modal-static .modal-content {
				padding: 0 !important; 
				margin: 0 !important;
			}
			.modal-static .modal-dialog .modal-content .modal-body {
                margin-top: -35px;
			}
            #loginModal .close {
                font-size: 27px;
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class='notifications top-right'></div>
        <div class="editor-logo shadow">
            <a href="../" title="PhotoPlus"><img src="../img/logo.png"/></a>    
        </div>
        <div class="zone-container shadow">        
            <div class="project-settings shadow">
                <a hre="#" class="openbtn" data-toggle="tooltip" data-placement="right" title="Settings"><i class="fa fa-gear"></i></a>        
            </div> 
            <div class="row" style="height:80px;">                                
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="padding:10px 0;">
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding:10px 15px 10px 19px; margin-top:18px;"> 
                    <button type="button" class="btn btn-start btn-block" name="save" style="font-weight:500; font-size:15px;" data-loading-text="Saving..." id="save"><i class="fa fa-cloud-upload fa-fw fa-lg"></i> Save</button>
                </div>                
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tabbable">
                        <ul class="nav nav-pills nav-justified" id="tabs"><!--nav-tabs nav-justified-->
                            <li><a href="#info" data-toggle="tab"><span class="fa fa-info-circle fa-fw fa-lg"></span> Info</a></li>
                            <li class="active"><a href="#data" data-toggle="tab"><span class="fa fa-database fa-fw fa-lg"></span> Data</a></li>
                            <li class="hide"><a href="#markers" data-toggle="tab"><span class="fa fa-map-marker fa-fw fa-lg"></span> Markers</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="info">
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <input class="form-control" id="title" name="title" placeholder="Name" type="text" autofocus />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" id="authorId" name="authorId" value="<?php if(isset($_SESSION['user_id'])) { echo $_SESSION['user_id'];} else { echo "-1"; } ?>"/>                                
                            </div>
                            <div class="tab-pane active" id="data">
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                                    
                                        <form id="fileupload" action="server/php/" method="POST" enctype="multipart/form-data">        
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-default fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span>Select file </span>
                                                <input type="file" name="files[]">
                                            </span>                    
                                            <!-- The global file processing state -->
                                            <div class="fileupload-process"></div>
                                            <div class="row row-top files"role="presentation">                                            
                                            </div>
                                        </form>
                                    </div>
                                    <script id="template-upload" type="text/x-tmpl">
                                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                                            <div class="template-upload fade col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">                                         
                                                        <p class="panel-title name">{%=file.name%}</p>   
                                                        <strong class="error text-danger"></strong>
                                                    </div>
                                                    <div class="panel-body">                                                        
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                        </div>
                                                        <div class="preview"></div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row" style="margin:0px">
                                                            {% if (!i && !o.options.autoUpload) { %}
                                                                <button class="btn btn-primary start pull-left" disabled>
                                                                    <i class="fa fa-cloud-upload"></i>
                                                                    <span>Upload</span>
                                                                </button>
                                                            {% } %}
                                                            {% if (!i) { %}
                                                                <button class="btn btn-warning cancel pull-right">
                                                                    <i class="fa fa-ban"></i>
                                                                    <span>Cancel</span>
                                                                </button>
                                                            {% } %}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {% } %}
                                    </script>
                                        <!-- The template to display files available for download -->
                                    <script id="template-download" type="text/x-tmpl">
                                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                                            <div class="template-download fade col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">                                         
                                                         <p class="name">
                                                            {% if (file.url) { %}
                                                                <a href="{%=file.url%}" id="filename" name="filename" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                                            {% } else { %}
                                                                <span>{%=file.name%}</span>
                                                            {% } %}
                                                        </p>
                                                        {% if (file.error) { %}
                                                            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                                        {% } %}
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="preview">
                                                            {% if (file.thumbnailUrl) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                                            {% } %}
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row" style="margin:0px;">
                                                            {% if (file.deleteUrl) { %}
                                                                <button class="btn btn-danger delete pull-left" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                                                    <i class="fa fa-trash-o"></i>
                                                                    <span>Delete</span>
                                                                </button>                                                             
                                                            {% } else { %}
                                                                <button class="btn btn-warning cancel pull-right">
                                                                    <i class="fa fa-ban"></i>
                                                                    <span>Cancel</span>
                                                                </button>
                                                            {% } %}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {% } %}
                                    </script>                                                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="markers">                                
                                <!-- Marker -->
                                <div id="point" class="hide">
                                    <div class="row row-top">
                                        <div class="col-lg-12 form-group">
                                            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="iconpicker">Select marker icon: </label>
                                            <button class="btn btn-default" id="iconpicker"></button>
                                        </div>                                
                                        <div class="col-lg-6">
                                            <label for="markerpicker">Select marker color: </label>
                                            <button class="btn btn-default" id="markerpicker"></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div id="markerIcon">
                                                <div id="markerBack" class="am am-red" class="text-center"><i id="iconFront" class="fa fa-adjust" style="color:#fff;margin-top:10px;"></i></div>
                                            </div>                        
                                        </div>
                                    </div>
                                </div>
                                <!-- Polygons -->
                                <div id="polygon" class="hide">
                                    <div class="row row-top">
                                        <div class="col-lg-12 form-group">
                                            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">     
                                        <div class="col-lg-12 form-group">
                                            <label for="ex1">Line size</label><br/>
                                            <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="50" data-slider-step="1" data-slider-value="14"/>
                                        </div>
                                    </div>
                                    <div class="row">                
                                        <div class="col-lg-12 form-group">
                                            <label>Line color</label><br/>
                                            <p>
                                                <b>Red</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="RC" id="R" data-slider-tooltip="hide" data-slider-handle="round" />
                                            </p>
                                            <p>
                                                <b>Green</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="GC" id="G" data-slider-tooltip="hide" data-slider-handle="round" />
                                            </p>
                                            <p>
                                                <b>Blue</b> <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value="128" data-slider-id="BC" id="B" data-slider-tooltip="hide" data-slider-handle="round" />
                                            </p>
                                            <div id="RGB"></div>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>        
        </div>
        <div id="leafletmap"></div>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="loginModalLabel">Sign in to your account</h4>
              </div>
              <div class="modal-body">
                <div class="container" style="max-width:480px;">                    
                    <div class="row row-top">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <form role="form" method="" action="" name="loginform" id="loginform">                                                                    
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email Address" required/>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password"  autocomplete="off" required/>
                                </div>
                                <div class="button-checkbox col-xs-12 col-sm-12 col-md-12">
                                    <button type="button" class="btn" style="outline:none;" data-color="info">Remember Me</button>
                                    <input type="checkbox" name="user_rememberme" id="user_rememberme" value="1" class="hidden">
                                    <a href="../login/password_reset.php" style="outline:none;" class="btn btn-link pull-right">Forgot Password?</a>
                                </div>                                                                  
                            </form>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="container" style="max-width:480px;">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="buttton" class="btn btn-start btn-block" data-loading-text="Loading...." name="login" value="Sign In" id="loginBtn">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="button" id="toRegister" class="btn btn-link btn-block" value="Create an account"/>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="registerModalLabel">Sign in to your account</h4>
              </div>
              <div class="modal-body">
                <div class="container" style="max-width:480px;">                    
                    <div class="row row-top">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <form role="form" method="" action="" name="registerform" id="registerform">                                                                    
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Display Name" pattern="[a-zA-Z0-9]{2,64}" required />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email Address" required>
                                </div>                    
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password_new" id="user_password_new" class="form-control" placeholder="Password" pattern=".{6,}" required autocomplete="off">
                                </div>                    
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password_repeat" id="user_password_repeat" class="form-control" placeholder="Confirm Password" pattern=".{6,}" required autocomplete="off">
                                </div>
                                <div class="form-group text-center">
                                    <img src="../login/tools/showCaptcha.php" alt="captcha" />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-puzzle-piece fa-fw"></i></span>
                                    <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Please enter these characters" required autocomplete="off">
                                </div>                                                                 
                            </form>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="container" style="max-width:480px;">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="button" name="register" value="Register" data-loading-text="Loading..." id="registerBtn" class="btn btn-start btn-block">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="button" id="toLogin" class="btn btn-link btn-block" value="Already have an account"/>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> 
        </div>      
		<div class="modal modal-static fade"  id="processing-modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Processing image</h4>
                    </div>
                    <div class="modal-body">
						<div class="preloader">
							<div class="wraptrapeze wraptrapeze1">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze2">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze3">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze4">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze5">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze6">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze7">
								<div class="trapeze"></div>
							</div>
							<div class="wraptrapeze wraptrapeze8">
								<div class="trapeze"></div>
							</div>
							<div class="line line1"></div>
							<div class="line line2"></div>
							<div class="line line3"></div>
							<div class="line line4"></div>
							<div class="circle">
								<div class="circle2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
        <script type="text/javascript" src="../js/vendor/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/prefixfree.min.js"></script>    
        <script type="text/javascript" src="../js/plugins.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="js/bootstrap-plugins.js"></script>
        <script type="text/javascript" src="js/leaflet.js"></script>
        <script tyue="text/javascript" src="js/leaflet.draw.js"></script>
		<script type="text/javascript" src="js/leaflet.plugins.js"></script>        
        <script type="text/javascript" src="js/jquery.fileupload.plugins.1.js"></script>       
        <script type="text/javascript" src="js/jquery.fileupload.js"></script>
        <script type="text/javascript" src="js/jquery.fileupload.plugins.2.js"></script>        
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript">
            var leafletUrl = 'https://{s}.tiles.mapbox.com/v3/foursquare.m3elv7vi/{z}/{x}/{y}.png';
            var leafletMap = new L.TileLayer(leafletUrl, {
                minZoom: 0, 
                maxZoom: 18, 
                noWrap: false
            });
            var map = new L.Map('leafletmap', {
                layers: [leafletMap], 
                //center: new L.LatLng(41.85,-87.65), 
                center: new L.LatLng(47.17394, 27.57483), 
                zoom: 13, 
                //zoomControl:false, 
                fullscreenControl: true        
            });       
            pageContentChange = 0;            
            $(document).ready(function() { 
                $("#save").click(function() {
                    var btn = $(this);
                    btn.button('loading');                    

                    //processFile();
                    if($("#authorId").val() > 0 ) {
                        //alert("User logged in");
                        
                        processFile();

                        btn.button('reset');
                    }
                    else {
                        //$("#processing-modal").modal("toggle");
                        $("#loginModal").modal("toggle"); 
                    }
                    

                    setTimeout(function() {
                        btn.button('reset');
                    }, 1000);   
                });

                function saveFile() {
                    var file = $("#filename").text();
                    if (file === "") { 
                        $('.top-right').notify({
                            message : {
                                text : 'Please add a file'
                            },
                            type : 'danger',
                            fadeOut : {
                                delay: 5000
                            }
                        }).show();
                        return; 
                    }
                    else {                        
                        var infoData = $('#info').find('input, textarea').serialize() + "&fileImage=" + file+"&save=1";
                        $.ajax({
                            type : "post",
                            url : "save.php",
                            dataType : "json",
                            data : infoData,
                            success : function(data) {
                                if(data.success) {
                                    window.location = "http://photoplus.app/editor/"+data.uid;
                                }
                                else {
                                    $('.top-right').notify({
                                        message : {
                                            text : data.message
                                        },
                                        type : 'danger',
                                        fadeOut : {
                                            delay: 5000
                                        }
                                    }).show();
                                }
                            },
                            error : function(data) {
                                $('.top-right').notify({
                                    message : {
                                        text : data.message
                                    },
                                    type : 'danger',
                                    fadeOut : {
                                        delay: 5000
                                    }
                                }).show();
                            }
                        });
                    }
                }

                function processFile() {
                    var file = $("#filename").text();
                    var folder = file.split('.')[0];            
                    $.ajax({
                        type: 'post',
                        url: 'server/php/fileprocess.php',
                        data: {
                            filename: file, 
                            foldername: folder
                        },
                        beforeSend: function() {                            
                            $("#processing-modal").modal("toggle");
                        },
                        success: function (data) {
                            //$("#alert").append(data);
                        },
                        error: function (data) {
                            $('.top-right').notify({
                                message : {
                                    text : data.message
                                },
                                type : 'danger',
                                fadeOut : {
                                    delay: 5000
                                }
                            }).show();
                        },
                        complete: function() {
                            $("#processing-modal").modal("toggle");
                            saveFile();
                        }
                    });
                }
                // Initialize the jQuery File Upload widget:
                $('#fileupload').fileupload({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: 'server/php/',
                    dataType: 'json',
                    dropzone: $('#data'),
                    autoUpload: false,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    maxFileSize: 500000000,        
                    maxNumberOfFiles: 1,
                    //disableImagePreview: true
                    previewMaxWidth: 200,
                    previewMaxHeight: 200,
                    previewCrop: false
                });
                $('#fileupload').bind('fileuploaddone', function (e, data) { pageContentChange = 1;});                            

                $("#toRegister").click(function() {
                    $("#loginModal").modal("toggle");
                    $("#registerModal").modal("toggle");
                });
                $("#toLogin").click(function() {
                    $("#loginModal").modal("toggle");
                    $("#registerModal").modal("toggle");
                });
                $("#loginBtn").click(function () {
                    var loginInfo = $("#loginform").find('input').serialize()+"&ajax=1&login=Log In";
                    console.log(loginInfo);
                    $.ajax({
                        type : 'post',
                        url  : 'ajax-login.php',
                        data : loginInfo,
                        success: function(data) {
                            $("#authorId").val(data); 
                            $("#loginModal").modal("toggle");
                            //alert(data);                    
                            console.log(data);
                        },
                        error: function(data) {
                            $("#loginModal").modal("toggle");
                            console.log(data);
                            //alert(data);   
                        }
                    });
                });
                $("#registerBtn").click(function () {
                    var registerInfo = $("#registerform").find('input').serialize()+"&ajax=1&register=Register";
                    console.log(registerInfo);
                    $.ajax({
                        type : 'post',
                        url  : 'ajax-login.php',
                        data : registerInfo,
                        success: function(data) {
                            $("authorId").val(data); 
                            $("#registerModal").modal("toggle");
                            //alert(data);                    
                            console.log(data);
                        },
                        error: function(data) {
                            $("#registerModal").modal("toggle");
                            console.log(data);
                            //alert(data);   
                        }
                    });
                });
                if(pageContentChange != 0) {
                    $(window).bind('beforeunload', function(){
                        return '>>>>>Before You Go<<<<<<<< \n Your custom message go here';
                    });
                }
            });
        </script>
    </body>
</html>
