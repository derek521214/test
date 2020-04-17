<?php
function generatePromotionSn(int $len){
    $str1 = '23456789ABCDEFGHIJKMNPQRSTUVWXYZ';
    $arr = explode('.',uniqid('',true));
    $str = strtoupper($arr[0]);
    $search = [1,0,'O','l','o'];
    $sn = str_replace($search,$str1[rand(1,30)],$str);
    return substr($sn,4, $len);
}

$arr = [];

for ($i=0;$i<1000;$i++) {
    $arr[] = generatePromotionSn(8);
}

var_dump(count($arr));
var_dump(count(array_unique($arr)));