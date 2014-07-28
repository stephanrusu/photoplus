<?php 
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	require_once("../login/config/config.php");
	if(isset($_GET['uid'])) {   
        $get_info = true;     
        try {
            $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);
            $uniqueId = htmlentities($_GET['uid']);        
            $query_select = $dbConnection->prepare("SELECT file_geojson FROM project WHERE unique_id = :uniqueId");
            $query_select->bindValue(':uniqueId', $uniqueId, PDO::PARAM_STR);
            $query_select->execute();
            if ($query_select->rowCount()) {                
                $result_row = $query_select->fetch(PDO::FETCH_ASSOC);
                $fileGeoJson = $result_row['file_geojson'];              
            }
            $dbConnection = null;            
        } catch(PDOException $e){
            echo 'Database error'.$e->getMessage();        
        }
    }  
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
   <head>
    <title>Leaflet</title>

    <link rel="stylesheet" href="css/leaflet.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="css/leaflet.plugins.css" />
  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
    }
    #map {
      position: absolute; 
      top: 0; 
      left: 0; 
      width: 100%; 
      height: 100%;      
    }
  </style>
</head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<div id="map"></div>
        <input type="hidden" id="fileGeoJson" value="<?php echo $fileGeoJson; ?>"/>
		<script tyue="text/javascript" src="../js/vendor/jquery-1.10.2.min.js"></script>
        <script tyue="text/javascript" src="js/leaflet-src.js"></script>            
		<script tyue="text/javascript" src="js/leaflet.plugins.js"></script>			
        <script type="text/javascript">
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
                var jsonInfo = getJson("http://localhost/photoplus/editor/server/php/" + fileGeoJson);                 
                //var leafletUrl = 'https://{s}.tiles.mapbox.com/v3/foursquare.m3elv7vi/{z}/{x}/{y}.png';
                var drawnItems = new L.FeatureGroup();
                var map = new L.TileLayer(jsonInfo.map, {
                    minZoom: 0, 
                    maxZoom: jsonInfo.maxZoom, 
                    noWrap: true
                });
                var map = new L.Map('map', {
                    layers: [map], 
                    //center: new L.LatLng(41.85,-87.65), 
                    center: new L.LatLng(0,0),
                    zoom: 1, 
                    zoomControl:true, 
                    fullscreenControl: false,
                    attributionControl: false        
                });
				map.addLayer(drawnItems);
                function onEachFeature(feature, layer) {
                    var popupContent = "";

                    if (feature.properties && feature.properties.popupContent) {
                        popupContent += feature.properties.popupContent;
                    }        
                    layer.bindPopup(popupContent);
                    drawnItems.addLayer(layer);
                }
                
                L.geoJson(jsonInfo, {
                    style: function(feature) {
                        var style = {
                            "color": feature.properties.color,
                            "weight": feature.properties.weight
                        };
                        return feature.properties && style;
                    },
                    onEachFeature: onEachFeature,
                    pointToLayer: function (feature, latlng) {
                        return L.marker(latlng, {icon: L.AwesomeMarkers.icon({icon: feature.properties.icon, prefix: 'fa', markerColor: feature.properties.color}) });
                    }
                }).addTo(map);              
				map.dragging.disable();
				map.touchZoom.disable();
				map.doubleClickZoom.disable();
				map.scrollWheelZoom.disable();
				map.boxZoom.disable();
				map.keyboard.disable();
				// Disable tap handler, if present.
				if (map.tap) map.tap.disable();
        </script>
    </body>
</html>
