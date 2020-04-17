<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 19:14
 */


require './Producer.php';

$rk = new rdkafka\kafka\Producer(['172.23.75.209:9092']);

$rk->setProducerTopic('spartan-sms-0');

$key = 'sms';
$msg =[
    'type'=>'sms',
    'data'=>[
        'ext'=>'',
        'extend'=>'',
        'sign'=>'SPARTAN',
        'params'=>[
            '王浩',
            '公开组10-13岁 09:00-11:30',
            '09:25'
        ],
        'tel'=>[
            'mobile'=>'13521011812',
            'nationcode'=>'86',
        ],
        'tpl_id'=>375899
    ]
];

for ($i=0;$i<1;$i++) {
    try {
        $rk->producer(json_encode($msg), $key);
    } catch (\Exception $e) {
        var_dump($e->getMessage());break;
    }
}



//$rk->setProducerTopic('spartan-sms-1');
//
//for ($i=0;$i<10;$i++) {
//    $rk->producer(json_encode($msg), $key);
//}

