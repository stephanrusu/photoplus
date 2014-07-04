<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?> - Photoplus </title>
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
        <link rel="stylesheet" type="text/css" href="css/preloader.css" />                      
        <script type="text/javascript" src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <style type="text/css">     
            #leafletmap { height: 100%; }			
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
            <div class="project-settings">
                <a hre="#" class="openbtn" data-toggle="tooltip" data-placement="right" title="Settings"><i class="fa fa-gear"></i></a>        
            </div> 
            <div class="row" style="height:80px;">                                                    
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="padding:10px 0;">
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding:10px 15px 10px 19px; margin-top:18px;">                 
                    <?php if(($login->isUserLoggedIn() == false ) && ($_SESSION['user_id'] !== $authorId)) { ?>
                        <button type="button" class="btn btn-start btn-block" name="edit" style="font-weight:500; font-size:15px;" data-loading-text="Loading..." id="edit"><i class="fa fa-edit fa-fw fa-lg"></i> Edit</button>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tabbable">
                        <ul class="nav nav-pills nav-justified"><!--nav-tabs nav-justified-->
                            <li class="active"><a href="#info" data-toggle="tab"><span class="fa fa-info-circle fa-fw fa-lg"></span> Info</a></li>
                            <li><a href="#share" data-toggle="tab"><span class="fa fa-share-alt fa-fw fa-lg"></span> Share</a></li>
                            <li class="hide"><a href="#markers" data-toggle="tab"><span class="fa fa-map-marker fa-fw fa-lg"></span> Markers</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="info">
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <input class="form-control" id="title" name="title" placeholder="Name" type="text" value="<?php echo $title; ?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="uniqueId" value="<?php echo $uniqueId; ?>" readonly>
                                <input type="hidden" name="authorId" value="<?php echo $authorId; ?>" readonly>                                   
                                <input type="hidden" name="fileGeoJson" id="fileGeoJson" value="<?php echo $fileGeoJson; ?>" readonly>                            
                            </div>
                            <div class="tab-pane" id="share">
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Facebook" class="btn btn-social-icon btn-lg btn-facebook"><i class="fa fa-lw fa-facebook"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Google+" class="btn btn-social-icon btn-lg btn-google-plus"><i class="fa fa-lw fa-google-plus"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on LinkedIn" class="btn btn-social-icon btn-lg btn-linkedin"><i class="fa fa-lw fa-linkedin"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Flickr" class="btn btn-social-icon btn-lg btn-flickr"><i class="fa fa-flickr"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Pinterest" class="btn btn-social-icon btn-lg btn-pinterest"><i class="fa fa-lw fa-pinterest"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Tumblr" class="btn btn-social-icon btn-lg btn-tumblr"><i class="fa fa-lw fa-tumblr"></i></a>&ensp;
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Twitter" class="btn btn-social-icon btn-lg btn-twitter"><i class="fa fa-lw fa-twitter"></i></a>
                                    </div>
                                </div>
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                        
                                        <input type="text" name="" id="project-url" class="form-control input-lg" required="required">
                                    </div>
                                </div>
                                <div class="row row-top">
                                    <div class="col-lg-12 form-group text-center">
                                        <div id="qrCodeProject"></div>
                                    </div>
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
            <div style="bottom: 0px; margin:10px; position:absolute;" id="infoAuthor">
                <a href="javascript:void(0);" class="btn btn-link trigger"><?php echo $name;?></a>
                <!-- <div class="head hide"><?php echo $name;?></div> -->
                <div class="content hide">
                    <ul class="social-links">
                        <li><a href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope fa-fw"></i></a></li>
                        <?php if(!empty($twitter)) { ?><li><a class="twitter-link" href="http://twitter.com/<?php echo $twitter; ?>"><i class="fa fa-twitter fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($facebook)) { ?><li><a class="facebook-link" href="http://facebook.com/<?php echo $facebook ?>"><i class="fa fa-facebook fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($googleplus)) { ?><li><a class="googleplus-link" href="http://plus.google.com/<?php echo $googleplus; ?>"><i class="fa fa-google-plus fa-fw"></i></a></li><?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id="leafletmap"></div>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style="font-size:25px;" aria-hidden="true">&times;</button>
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
                        <button type="button" class="close" data-dismiss="modal" style="font-size:25px;" aria-hidden="true">&times;</button>
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
        <script type="text/javascript" src="../js/vendor/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/prefixfree.min.js"></script>    
        <script type="text/javascript" src="../js/plugins.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="js/bootstrap-plugins.js"></script>
        <script type="text/javascript" src="js/leaflet.js"></script>
        <script tyue="text/javascript" src="js/leaflet.draw.js"></script>        
        <script tyue="text/javascript" src="js/leaflet.plugins.js"></script>        
        <script type="text/javascript" src="js/qrcode.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {                 
                $("#project-url").val(window.location.href);
                $("#qrCodeProject").qrcode({
                    render: 'image',
                    size: 150,
                    fill: '#333',
                    text: window.location.href
                }); 
                $(".trigger").popover({
                    html: true,
                    placement: 'top',
                    title:  function() {
                        return $(this).parent().find('.head').html();
                    },
                    content: function() {
                        return $(this).parent().find('.content').html();
                    }
                });
                $("#edit").click(function() {
                    var btn = $(this);
                    btn.button('loading');                    
                    $("#loginModal").modal("toggle"); 
                    btn.button('reset');
                    

                    setTimeout(function() {
                        btn.button('reset');
                    }, 1000);   
                });
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
                            $("#loginModal").modal("toggle");
                            window.location.reload();
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
                            //$("authorId").val(data);                         
                            $("#registerModal").modal("toggle");
                            window.location.reload();
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
            }); 
                //$.getJSON("http://<?php echo $_SERVER['SERVER_NAME']; ?>/photoplus/editor/server/php/" + fileGeoJson, function (data) {
                var fileGeoJson = $("#fileGeoJson").val();
                function getJson(url) {
                    return JSON.parse($.ajax({
                        type: 'GET',
                        url: url,
                        dataType: 'json',
                        global: false,
                        async:false,
                        success: function(data) {
                            return data;
                        }
                    }).responseText);
                }
                var jsonInfo = getJson("https://photoplus.app/editor/server/php/" + fileGeoJson);                 
                //var leafletUrl = 'https://{s}.tiles.mapbox.com/v3/foursquare.m3elv7vi/{z}/{x}/{y}.png';
                var drawnItems = new L.FeatureGroup();
                var leafletMap = new L.TileLayer(jsonInfo.map, {
                    minZoom: 0, 
                    maxZoom: jsonInfo.maxZoom, 
                    noWrap: true
                });
                var map = new L.Map('leafletmap', {
                    layers: [leafletMap,drawnItems], 
                    //center: new L.LatLng(41.85,-87.65), 
                    center: new L.LatLng(0,0),
                    zoom: 2, 
                    //zoomControl:false, 
                    fullscreenControl: true        
                });
                //var hash = new L.Hash(map);
                map.addLayer(drawnItems);
                function isEmpty(o) {
                    for (var i in o) { return false; }
                    return true;
                }
                function showProperties(l) {                
                    var layerGeoJson = l.toGeoJSON(), form = '';
                    var properties = layerGeoJson.properties;
                    if (isEmpty(properties)) properties = { '': '' };
                    form +='<div class="featureContext">'+
                            '<div class="form-group">'+
                                '<input type="hidden" value="popupContent" class="featureKey">'+
                                //'<input type="text" class="form-control featureValue" value="'+properties['popupContent']+'">'+
                                '<textarea class="form-control featureValue">'+properties['popupContent']+'</textarea>'+
                            '</div></div>';
                    if(layerGeoJson.geometry.type != 'Point') {
                        form += '<div class="featureContext hide">'+
                                    '<div class="form-group">'+
                                        '<input type="hidden" value="color" class="featureKey">'+
                                        '<input type="text" class="form-control featureValue" value="'+properties['color']+'">'+
                                    '</div>'+
                                '</div>'; 
                        form += '<div class="featureContext hide">'+
                                '<div class="form-group">'+
                                    '<input type="hidden" value="weight" class="featureKey">'+
                                    '<input type="text" class="form-control featureValue" value="'+properties['weight']+'">'+
                                '</div></div>';
                    } else {
                        form += '<div class="featureContext hide " >'+
                                    '<div class="form-group">'+
                                        '<input type="hidden" value="color" class="featureKey">'+
                                        '<input type="text" class="form-control featureValue" value="'+properties['color']+'">'+
                                    '</div>'+
                                '</div>'; 
                        form += '<div class="featureContext hide" > '+
                                    '<div class="form-group">'+
                                        '<input type="hidden" value="icon" class="featureKey">'+
                                        '<input type="text" class="form-control featureValue" value="'+properties['icon']+'">'+
                                    '</div>'+
                                '</div>';
                    }
                    if (form) {
                        if(l.feature.geometry.type == 'Point') {                    
                            l.setIcon(L.AwesomeMarkers.icon({icon: l.feature.properties.icon, prefix: 'fa', markerColor: l.feature.properties.color}));                     
                        } else {                        
                            l.setStyle({"color":l.feature.properties.color, "weight": l.feature.properties.weight});                        
                        }
                        l.bindPopup('<div class="">' + form + '</div>');                        
                    }
                }
                L.geoJson(jsonInfo).eachLayer(function(l) {
                    showProperties(l);
                    l.addTo(drawnItems);
                }); 
                var baseLayers = null

                var overlays = {
                    "Layers": drawnItems
                };

                L.control.layers(baseLayers, overlays).setPosition("bottomright").addTo(map);
        </script>
    </body>
</html>
