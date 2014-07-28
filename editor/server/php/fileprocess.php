<?php   
    if($_POST) {
        define('tileSize', '256');
        define('percent','0.5');

        $source = $_POST['filename'];
        $destFolder = $_POST['foldername'];
        $json = array(
            'success' => false,
            'message' => '',

        );
        function zoomLevel($width, $height) {
            $maxTileDim = ceil(max($width, $height) / tileSize);        
            $maxZlvl = 0;        
            do {
                $maxZlvl++;            
            } while (pow(2, $maxZlvl) < $maxTileDim);
            return $maxZlvl;
        }

        function createTile($folder, $fileImage, $zCoord, $xCoord, $yCoord) {        
            $xCrop = $xCoord * tileSize;
            $yCrop = $yCoord * tileSize;
            $fileImageTemp = clone $fileImage;
            $fileImageTemp->cropImage(tileSize, tileSize, $xCrop, $yCrop);
            $fileImageTemp->setImageFormat("jpg");
            $fileImageTemp->setImageFileName($folder."/".$zCoord."/".$xCoord."/".$yCoord.".jpg");
            $fileImageTemp->writeImage();
            $fileImageTemp->clear();       
        }

        function resizeImage($fileImage) {
            $fileImageTmp = clone $fileImage;      
            $oldWidth = $fileImageTmp->getImageWidth();
            $oldHeight = $fileImageTmp->getImageHeight();
            $newWidth = $oldWidth * percent;
            $newHeight = $oldHeight * percent;
            $fileImageTmp->thumbnailImage($newWidth,$newHeight);    
            return $fileImageTmp;
        }   
        
        // contruction & preparation        
        
        $fileSource  = new Imagick('E:/Diverse/xampp/htdocs/photoplus/editor/server/php/files/'.$source);
        $fileSrcWidth = $fileSource->getImageWidth();
        $fileSrcHeight = $fileSource->getImageHeight();
            
        $maxZoomLevel = zoomLevel($fileSrcWidth, $fileSrcHeight);    

        $sizeFile = tileSize * pow(2, $maxZoomLevel);
        
        $fileDestination = new Imagick();
        $fileDestination->newImage($sizeFile, $sizeFile, "rgb(229,227,223)");
        
        $fileDestination->compositeImage($fileSource,imagick::COMPOSITE_COPY,
            intval(($sizeFile - $fileSrcWidth) / 2), intval(($sizeFile - $fileSrcHeight) / 2));    
                   
        $XYtileDim = $sizeFile / tileSize;
        $folder = __DIR__."/".$destFolder;

        //end construction          
        if (!file_exists($folder)) {
                mkdir($folder);
        }           
        for ($zCoord = $maxZoomLevel; $zCoord >= 0 ; $zCoord--) { 
            mkdir($folder . "/" . $zCoord);             
            for ($xCoord = 0; $xCoord < $XYtileDim; $xCoord++) { 
                mkdir($folder."/".$zCoord . "/" .$xCoord);
                for ($yCoord = 0; $yCoord < $XYtileDim; $yCoord++) {                                 
                    createTile($folder, $fileDestination, $zCoord, $xCoord, $yCoord);
                }
            }       
            $fileDestination = resizeImage($fileDestination);
            $newDimFile = $fileDestination->getImageWidth();            
            $XYtileDim = $newDimFile / tileSize;            
        }      
        $fileSource->clear();
        $fileDestination->clear();

        $json['success'] = true;
        $json['message'] = "Process finish";


        $mapGeoJson = array(
            "map" => "http://localhost/photoplus/editor/server/php/".$destFolder."/{z}/{x}/{y}.jpg",
            "minZoom" => 0,
            "maxZoom" => $maxZoomLevel,
            "type" => "FeatureCollection",
            "features" => array()
        );
        $fileImage = explode(".", $source);
        $fileGeoJson = fopen($fileImage[0].".json",'w');
        fwrite($fileGeoJson, json_encode($mapGeoJson));
        fclose($fileGeoJson);

        //echo json_encode($json);
    }
    else {
        $json['message'] = 'error';
        echo json_encode($json);
    }
?>
