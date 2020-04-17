<?php
//背景图片路径
$srcurl = './background.png';
//目标图片路径
$desurl = './small.png';

//创建源图的实例
//$src = imagecreatefromstring(file_get_contents($srcurl));
$src = getImg($srcurl);
//创建点的实例
$des = getImg($desurl);
//获取点图片的宽高
list($point_w, $point_h) = getimagesize($desurl);

//重点：png透明用这个函数
imagecopy($src, $des, 100, 1600, 0, 0, $point_w, $point_h);

imagecopy($src, $des, 300, 1600, 0, 0, $point_w, $point_h);
//imagecopy($src, $des, 100, 1600, 0, 0, $point_w, $point_h);


$col = imagecolorallocatealpha($src,0,0,0,0);

imagettftext($src,30,0,215,875,$col,"./font/msyhl.ttc",'test');

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

header('Content-Type: image/jpeg');
imagejpeg($src);
imagedestroy($src);
imagedestroy($des);