<?php
$w   = 1080;
$h   = 1920;
$img = imagecreatetruecolor($w, $h);
//这一句一定要有
imagesavealpha($img, true);
//拾取一个完全透明的颜色,最后一个参数127为全透明
$bg = imagecolorallocatealpha($img, 0, 0, 0, 100);
imagefill($img, 0, 0, $bg);

$srcurl = './super.png';
//目标图片路径
$desurl = './upload.png';

$src = getImg($srcurl);
//创建点的实例
$des = getImg($desurl);

list($point_w, $point_h) = getimagesize($desurl);
//重点：png透明用这个函数
imagecopy($img, $des, 163, 364, 0, 0, $point_w, $point_h);

list($w, $h) = getimagesize($srcurl);
imagecopy($img, $src, 0, 0, 0, 0, $w, $h);

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

header("content-type:image/jpeg");
imagepng($img);
imagedestroy($img);



