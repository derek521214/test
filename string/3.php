<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/4/15
 * Time: 13:30
 */

// 2019-06-01 上午

//$str ='2019-06-01 上午';
//
//$res =preg_match('/^\d{4}-\d{2}-\d{2}\s[上午|下午]/',$str,$matchs);
//
//var_dump($res, $matchs);

/*$code = 'HHFREE369142';

$res = preg_match('/^HH(FREE|PAY|SGX|DS|KBL)?\d{6}$/', $code);*/

$code = '2019/15/14';

$res = boolval(preg_match('/^\d{4}\/\d{1,2}\/\d{1,2}$/', $code));

$res = str_replace("/","-", $code);

var_dump($res);