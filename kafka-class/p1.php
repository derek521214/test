<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 19:14
 */


require './Producer.php';

$rk = new rdkafka\kafka\Producer(['172.23.75.209:9092']);

$rk->setProducerTopic('spartan-email-0');

$key = 'email';
$msg =[
    'type'=>'email',
    'data'=>[
        'from'=>'spartan@spartan.zhibo.tv',
        'to'=>'wanghao@zhibo.tv',
        'subject'=>'测试测试',
        'fromName'=>'斯巴达勇士赛（SPARTAN）',
        'html'=>'斯巴达勇士赛（SPARTAN）报名测试',
        'contentSummary'=>'测试',
    ]
];

$num = 1;

for ($i=0;$i<$num;$i++) {
    $rk->producer(json_encode($msg), $key);
}



