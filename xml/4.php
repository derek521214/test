<?php
//$str = '159.20';
//echo intval($str *100);


$str = '159';
$str1 = '15900';
$res = bcmul(floatval($str), 100);
$str1 = intval($str1);
//var_dump($res);
//var_dump(intval($res) == $str1);

//$a = 100;
//
//if ($a>20) {
//    echo 20;
//} else if ($a>50) {
//    echo 50;
//} else {
//    echo $a;
//}

$i = 100;

switch ($i) {
    case $i<10:
        echo 1;
        break;
    case $i<100:
        echo 2;
        break;
    case $i<1000:
        echo 3;
        break;
    default:
        break;
}

echo date('Y-m-d H:i:s');
echo PHP_EOL;
echo strtotime('2020-3-1');
echo PHP_EOL;
echo strtotime(date('Y-m-d H:i:').'00');
