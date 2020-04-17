<?php

$background = dirname( __DIR__) .'/images/background.png';

$background = realpath($background);

$img1 = dirname(__DIR__). '/images/small.png';
$img1 = realpath($img1);


function getImg($img) {
    $groundInfo = getimagesize($img);
    $newImg = null;
    switch($groundInfo[2]){
        case 1:
            $newImg = imagecreatefromgif($img);
            imagesavealpha($newImg,true);
            break;
        case 2:
            $newImg = imagecreatefromjpeg($img);
            imagesavealpha($newImg,true);
            break;
        case 3:
            $newImg = imagecreatefrompng($img);
            imagesavealpha($newImg,true);
            break;
    }
    return $newImg;
}

function mergeImg(&$background, $img1)
{
    imagecopy($background, $img1, 200, 1600, 0, 0, 100, 100);
}




function outPut($img, $quality = 9)
{
    ob_clean();
    header("Content-type: image/png");

    imagepng($img,NULL,intval($quality));

    imagedestroy($img);
}

$back = getImg($background);

$image1 = getImg($img1);

/*$small = imagecreatetruecolor(100,100);
imagealphablending($small,true);
imagesavealpha($small,true);*/


mergeImg($back, $image1);

outPut($back);




