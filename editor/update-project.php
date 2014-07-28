<?php  

?>
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
            <div class="project-settings shadow">
                <a hre="javascript:void(0);" class="openbtn" data-toggle="tooltip" data-placement="right" title="Settings"><i class="fa fa-gear"></i></a>        
            </div> 
            <div class="row" style="height:80px;">                                
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="padding:10px 0;">
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding:10px 15px; 10px 19px; margin-top:18px;"> 
                    <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $authorId)) { ?>
                    <button type="button" class="btn btn-start btn-block" name="update" style="font-weight:500; font-size:15px;" data-loading-text="Updating..." id="update"><i class="fa fa-cloud-upload fa-fw fa-lg"></i> Update</button>
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
                                <input type="hidden" id="uniqueId" name="uniqueId" value="<?php echo $uniqueId; ?>" readonly>
                                <input type="hidden" id="authorId" name="authorId" value="<?php echo $authorId; ?>" readonly>                                   
                                <input type="hidden" id="fileGeoJson" name="fileGeoJson" id="fileGeoJson" value="<?php echo $fileGeoJson; ?>" readonly>                            
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
                                        <input type="text" name="" id="project-url" class="form-control input-lg" required="required" onclick="this.select()" >
                                    </div>
                                </div>
                                <div class="row row-top">
                                    <div class="col-lg-12 form-group text-center">
                                        <div id="qrCodeProject"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="markers">                                                                
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            <div class="row">
                <div style="bottom: 0px; margin:0 0 20px 15px; position:absolute; left: 0;" id="infoAuthor">
                    <a href="javascript:void(0);" class="btn btn-default trigger"><?php echo $name;?></a>
                    <!-- <div class="head hide"><?php echo $name;?></div> -->
                    <div class="content hide">
                        <ul class="social-links">
                            <li><a href="../login"><i class="fa fa-user fa-fw"></i></a></li>
                            <li><a href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope fa-fw"></i></a></li>
                            <?php if(!empty($twitter)) { ?><li><a class="twitter-link" href="http://twitter.com/<?php echo $twitter; ?>"><i class="fa fa-twitter fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($facebook)) { ?><li><a class="facebook-link" href="http://facebook.com/<?php echo $facebook ?>"><i class="fa fa-facebook fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($googleplus)) { ?><li><a class="googleplus-link" href="http://plus.google.com/<?php echo $googleplus; ?>"><i class="fa fa-google-plus fa-fw"></i></a></li><?php } ?>
                        </ul>
                    </div>
                </div>
                <div style="bottom: 0px; right:0; margin:0 15px 20px 0px; position:absolute; float:right">
                    <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-default" id="deleteBtn"><i class="fa fa-trash-o fa-fw fa-lg"></i>
                    </button>
                </div>
            </div>        
        </div>
        <div id="leafletmap"></div> 		
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
            pageContentChange = 0;
             
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
            var jsonInfo = getJson("http://localhost/photoplus/editor/server/php/" + fileGeoJson); 
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
                  
            map.addLayer(drawnItems);

            var exportJson = new L.Control.ExportJSON();
            map.addControl(exportJson);

            var colorIcon = [
                'red', 'orange', 'green', 
                'blue', 'purple', 'darkred', 
                'darkblue', 'darkgreen', 'darkpurple', 
                'cadetblue', 'lightred', 'beige',  
                'lightgreen', 'lightblue', 'pink',
                'lightgray', 'gray', 'black'
            ];
            var iconFa = ['star', 'apple', 'shield', 'user', 'lock','circle','cog'];
            var propertiesIcon = {
                'popupContent': '',
                'icon': iconFa[Math.floor(Math.random()*iconFa.length)],
                'color': colorIcon[Math.floor(Math.random()*colorIcon.length)]
            };    
            var propertiesShape = {
                'popupContent': '',
                'color': '#0099ff',
                'weight': 4
            };    
            var drawControl = new L.Control.Draw({
                position: 'topright',
                draw: {
                    polygon: {
                        title: 'Draw a polygon!',
                        allowIntersection: false,
                        drawError: {
                            color: '#f00',
                            timeout: 1000
                        },
                        shapeOptions: {
                            color: propertiesShape.color,
                            weight: propertiesShape.weight
                        },
                        showArea: true
                    },
                    polyline: {
                        metric: false,
                        shapeOptions: {
                            color: propertiesShape.color,
                            weight: propertiesShape.weight
                        }
                    },
                    rectangle: {
                        shapeOptions: {
                            color: propertiesShape.color,
                            weight: propertiesShape.weight
                        }
                    },
                    circle: false, 
                    marker: {
                        icon: L.AwesomeMarkers.icon({
                            icon: propertiesIcon.icon, 
                            prefix: 'fa', 
                            markerColor: propertiesIcon.color
                        })
                    }
                },
                edit: {
                    featureGroup: drawnItems
                }
            });
            map.addControl(drawControl);

            map.on('draw:created',drawCreated);
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
                            '<textarea class="form-control featureValue">'+properties['popupContent']+'</textarea>'+
                        '</div></div>';
                if(layerGeoJson.geometry.type != 'Point') {
                    form += '<div class="featureContext">'+
                                '<div class="form-group">'+
                                    '<input type="hidden" value="color" class="featureKey">'+                                    
                                    '<input type="text" class="form-control featureValue colorpicker" value="'+properties['color']+'">'+
                                '</div></div>'; 
                    form += '<div class="featureContext">'+
                            '<div class="form-group">'+
                                '<input type="hidden" value="weight" class="featureKey">'+                                
                                '<input class="form-control featureValue wSlider" data-slider-id="wSlider" type="text" data-slider-min="1" data-slider-max="50" data-slider-step="1" data-slider-value="'+properties['weight']+'"/>'+
                            '</div></div>';
                } else {
                    form += '<div class="featureContext">'+
                                '<div class="input-group form-group">'+
                                    '<input type="hidden" value="color" class="featureKey">'+
                                    '<input type="text" class="form-control dropdown-text featureValue" value="'+properties['color']+'" style="border-top-left-radius: 4px; border-bottom-left-radius: 4px;">'+
                                    '<div class="input-group-btn">'+
                                        '<button tabindex="-1" data-toggle="dropdown" class="btn btn-start" type="button" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;"><span class="caret"></span></button>'+
                                        '<ul class="dropdown-menu pull-right" role="menu" style="height: auto;overflow-x: hidden;max-height:155px;" ></ul>'+
                                    '</div>'+
                                '</div></div>';                           
                    form += '<div class="featureContext"> '+                               
                                '<div class="input-group form-group">'+
                                    '<input type="hidden" value="icon" class="featureKey">'+
                                    '<input type="text" class="form-control featureValue iconpicker" value="'+properties['icon']+'" style="border-top-left-radius: 4px; border-bottom-left-radius: 4px;">'+
                                    '<div class="input-group-btn">'+
                                        '<button tabindex="-1" class="btn btn-start" class="input-group-addon" id="iconpicker" type="button" ></button>'+
                                    '</div>'+
                                '</div></div>';
                }
                if (form) {
                    if(l.feature.geometry.type == 'Point') {                    
                        l.setIcon(L.AwesomeMarkers.icon({icon: l.feature.properties.icon, prefix: 'fa', markerColor: l.feature.properties.color}));                     
                    } else {                        
                        l.setStyle({"color":l.feature.properties.color, "weight": l.feature.properties.weight});                        
                    }
                    l.bindPopup('<div class="">' + form + '</div>' +
                    '<button class="save btn btn-xs btn-start">Save</button>' +
                    '<button class="cancel btn btn-xs btn-default">Cancel</button>');
                }
            }           
            function geoify(layer) {
                var features = [];
                layer.eachLayer(function(l) {
                    if ('toGeoJSON' in l) {
                        var localLayer = l.toGeoJSON();
                        //console.log(localLayer);
                        if (isEmpty(localLayer.properties)) {
                            if(localLayer.geometry.type == 'Point') {
                                localLayer.properties = propertiesIcon;
                                //l.setIcon(L.AwesomeMarkers.icon({icon: localLayer.properties.icon, prefix: 'fa', markerColor: localLayer.properties.color}));
                            } else {
                                localLayer.properties = propertiesShape;
                                //l.setStyle({"color":localLayer.properties.color, "weight": localLayer.properties.weight});
                            }
                        }
                        features.push(localLayer);
                    }
                });
                layer.clearLayers();
                //console.log(features);
                L.geoJson({ type: 'FeatureCollection', features: features }).eachLayer(function(l) {
                    if(l.feature.geometry.type == 'Point') {
                        //l.feature.properties = propertiesIcon;
                        l.setIcon(L.AwesomeMarkers.icon({icon: l.feature.properties.icon, prefix: 'fa', markerColor: l.feature.properties.color}));
                    } else {
                        //l.feature.properties = propertiesShape;
                        l.setStyle({"color":l.feature.properties.color, "weight": l.feature.properties.weight});
                    }
                    //l.bindPopup(l.feature.properties.popupContent);
                    l.addTo(layer);
                });
            }               
            function drawCreated(e) {
                pageContentChange = 1;
                drawnItems.addLayer(e.layer);
                geoify(drawnItems); 
                refresh();                         
            }           
            function refresh() {
                drawnItems.eachLayer(function(l) {
                    showProperties(l);
                });
            }   
            map.on('popupopen', popupOpen);
            
            function popupOpen(e) {
                //var sel = e.popup._source;                
                var contentNode = e.popup._contentNode;             
                $('.wSlider').slider({
                    formater: function(value) {
                        return value;
                    }
                });
                function createDropdown() {         
                    var colorValue = [
                        'rgb(214, 62, 42)','rgb(246, 151, 48)','rgb(114, 175, 38)',
                        'rgb(55, 167, 218)','rgb(207, 81, 182)','rgb(159, 50, 53)',
                        'rgb(0, 103, 163)','rgb(114, 130, 36)','rgb(89, 56, 105)',
                        'rgb(67, 105, 120)','rgb(255, 142, 127)','rgb(255, 203, 146)',
                        'rgb(187, 249, 112)','rgb(138, 218, 255)','rgb(255, 145, 234)',
                        'rgb(162, 162, 162)','rgb(87, 87, 87)','rgb(48, 48, 48)'
                    ];
                    var dropList = '';
                    for (var color in colorIcon) {
                        dropList += '<li><a class="linkSelector" href="javascript:void(0);"><i class="btn-selector" style="background-color:'+colorValue[color]+';"></i>'+colorIcon[color]+' </a></li>';
                    }
                        $(".dropdown-menu").append(dropList);
                }
                createDropdown();
                $(".dropdown-menu li a").click(function(){
                    var selText = $(this).text();
                    $('.dropdown-menu > li').removeClass("active");
                    $(this).parents().addClass("active");
                    $(this).parents('.input-group').find('.dropdown-text').val(selText);
                }); 
                $('#iconpicker').iconpicker({
                    iconset: 'fontawesome',
                    rows: 3,
                    cols: 8,
                    placement: 'bottom'
                });      
                $('#iconpicker').on('change', function(e) {
                    $('#iconFront').attr('class', '').addClass('fa ' + e.icon);                     
                    var value = e.icon.split('fa-')
                    $('.iconpicker').val(value[1]);
                });             

                $(".colorpicker").colorpicker();                                
                
                $('.cancel').on("click",closePopup);
                $('.save').on("click",savePopup);               

                function closePopup(){
                    map.closePopup(e.popup);
                }               
                function savePopup(){
                    var obj = {};                    
                    var nodes = $(contentNode).find('div.featureContext');
                    nodes.each(function() {
                        var key = $(this).find("input.featureKey").val();
                        var value = $(this).find("input.featureValue, textarea.featureValue").val();
                        obj[key] = value;
                    }); 
                    console.log(obj);
                    e.popup._source.feature.properties = obj;                                                           
                    map.closePopup(e.popup);                    
                    refresh();
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
                $("#deleteBtn").click(function() {
                    var infoData = $("#uniqueId").serialize() + "&delete=1";
                    $.ajax({
                        type : "post",
                        url : "delete.php",
                        dataType : "json",
                        data: infoData,
                        success : function(data) {
                            if(data.success) {
                                window.location = "http://photoplus.app/editor/";
                            }
                            else {
                                $(".top-right").notify({
                                    message : {
                                        text : data.message
                                    },
                                    type: 'danger',
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
                });
                $("#update").click(function() {
                    var btn = $(this);
                    btn.button('loading');                    
                    var infoData = $('#info').find('input, textarea').serialize() + "&update=1";
                    $.ajax({
                        type : "post",
                        url : "update.php",
                        dataType : "json",
                        data : infoData,
                        success : function(data) {
                            if(data.success) {
                                $('.top-right').notify({
                                    message : {
                                        text : data.message
                                    },
                                    type : 'success',
                                    fadeOut : {
                                        delay: 5000
                                    }
                                }).show();
                                pageContentChange = 1;
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
                    setTimeout(function() {
                        btn.button('reset');
                    }, 1000);   
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
