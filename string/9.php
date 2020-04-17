<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/11/7
 * Time: 15:06
 */


//var_dump(hexdec(sha1('252841091@qq.com'))/pow(10,45));


/*$str = '公开组 10:00-12:00';

$preg = '/\d+:\d+-+\d+:+\d\d/';
preg_match($preg,$str,$arr);
$noTimeName = preg_replace($preg,"",$str);

$res = str_replace($arr[0], '', $str);

var_dump($arr, $noTimeName, trim($res));*/


$a = [1,2,3,4,5];
$b = [1,2,3,4,5];


foreach ($a as $i) {

    foreach ($b as $m) {
        echo $i. '-'.$m.PHP_EOL;
        if ($m==3) {
            goto aa;
        }
    }
}

aa: echo 'ok';
