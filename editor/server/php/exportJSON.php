<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
    if(isset($_POST['fileGeoJSON'])) {

        $string = file_get_contents($_POST['fileName']);
        $fileJSON = json_decode($string, true);

        if($_SESSION['user_id'] === $_POST['author']) {
            $mapGeoJSON = array(
                "map" => $fileJSON['map'],
                "minZoom" => $fileJSON['minZoom'],
                "maxZoom"=> $fileJSON['maxZoom'],
                "type"=> "FeatureCollection"    
            );
            //array_push($mapGeoJSON['features'], json_decode($_POST['fileGeoJSON'],true));
            $mapGeoJSON['features'] = json_decode($_POST['fileGeoJSON'],true);
            $fileGeoJson = fopen($_POST['fileName'],'w');
            fwrite($fileGeoJson, json_encode($mapGeoJSON));
            fclose($fileGeoJson);
            echo "Export complete";
        }
        else {
            echo "Not allowed to export";
        }
    }
    else {
        echo "File not sent!";
    }
?>