<?php

function image_crop($filename, $width, $height) {
    header('Content-Type: image/jpeg');
    // načtení původních rozměrů
    list($src_w, $src_h, $typ) = getimagesize($filename);
 
    $src_img = imagecreatefromjpeg($filename);
    $big_img = imagecreatetruecolor($height, $width);
 
    if ($src_w == $src_h) {
        $s_w = $s_h = 0;
        $t = $src_w;
        }
        elseif ($src_w > $src_h) {
            $t = $src_h;
            $s_h = 0;
            $s_w = round(($src_w - $src_h) / 2);
            }
        elseif ($src_w < $src_h) {
            $t = $src_w;
            $s_w = 0;
            $s_h = round(($src_h - $src_w) / 2);
            }
    imagecopyresampled($big_img, $src_img, 0, 0, $s_w, $s_h, $height, $width, $t, $t);
    imagejpeg($big_img, null, 90);
    imagedestroy($big_img); 
    imagedestroy($src_img); 
    return exit; 
    }

function resize($filename, $width) {
    header('Content-Type: image/jpeg');
    // načtení původních rozměrů
    list($width_orig, $height_orig) = getimagesize($filename);
    // nové rozměry obrázku na výšku
    $ratio_orig = $width_orig/$height_orig;
    $height = $width/$ratio_orig;
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    imagejpeg($image_p, null, 90);
    imagedestroy($image); 
    imagedestroy($image_p); 
    return exit; 
    }

//resize($_GET['filename'], $_GET['width']); 

image_crop($_GET['filename'], $_GET['width'], $_GET['width']); 
    
?>    