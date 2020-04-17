<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/3/27
 * Time: 11:04
 */

$str = '恭喜您{userName}报名成功2019斯巴达勇士赛，完成挑战的第一步！您的参赛信息如下，请仔细阅读：
Congratulations on your successful registration of the 2019 Spartan Super Race and and take your first step！Please keep a note on the following information about your competition:
比赛日期/Race Date : {date} 
比赛组别/Race Category：{group}';

$search = ['{userName}','{date}','{group}'];
$replace = ['derek','2019-03-27','男子精英组'];

var_dump(str_replace($search, $replace, $str));


//echo  md5('PsZjz6*vp0kqmio8'.'1'.'99999');