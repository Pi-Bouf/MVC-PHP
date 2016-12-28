<?php

function cropImg($source, $destination, $sizeDest) {
    switch(substr($source, strlen($source) - 3, 3)) {
        case 'jpg':
        case 'jpeg':
        {
            $image_original = imagecreatefromjpeg($source);
            break;
        }
        case 'png':
        {
            $image_original = imagecreatefrompng($source);
            break;
        }
        case 'gif':
        {
            $image_original = imagecreatefromgif($source);
            break;
        }
    }

    $image_cropped = imagecreatetruecolor($sizeDest, $sizeDest);
    $white = imagecolorallocate($image_cropped, 255, 255, 255);
    imagefill($image_cropped, 0, 0, $white);

    if(imagesx($image_original) >= imagesy($image_original)) {
        imagecopyresampled($image_cropped, $image_original, 0, 0, (imagesx($image_original) - imagesy($image_original)) / 2, 0, $sizeDest, $sizeDest, imagesy($image_original), imagesy($image_original));
    } else {
        imagecopyresampled($image_cropped, $image_original, 0, 0, 0, (imagesy($image_original) - imagesx($image_original)) / 2, $sizeDest, $sizeDest, imagesx($image_original), imagesx($image_original));
    }
    
    imagejpeg($image_cropped, $destination, 100);
}

?>