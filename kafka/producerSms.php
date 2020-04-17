<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/12
 * Time: 14:22
 */




$conf = new RdKafka\Conf();
$conf->setDrMsgCb(function ($kafka, $message) {
    file_put_contents("./dr_cb.log", var_export($message, true).PHP_EOL, FILE_APPEND);
});
$conf->setErrorCb(function ($kafka, $err, $reason) {
    file_put_contents("./err_cb.log", sprintf("Kafka error: %s (reason: %s)", rd_kafka_err2str($err), $reason).PHP_EOL, FILE_APPEND);
});

$rk = new RdKafka\Producer($conf);

$rk->setLogLevel(LOG_DEBUG);
$rk->addBrokers("172.23.75.209:9092");

$cf = new RdKafka\TopicConf();
// -1必须等所有brokers同步完成的确认 1当前服务器确认 0不确认，这里如果是0回调里的offset无返回，如果是1和-1会返回offset
// 我们可以利用该机制做消息生产的确认，不过还不是100%，因为有可能会中途kafka服务器挂掉
$cf->set('request.required.acks', -1);

$topic = $rk->newTopic("spartan-sms", $cf);

/*$i = 0;
$key = 'sms';
while (true) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i", $key);
    $rk->poll(0);
    $i++;
}*/

$key = 'sms';
$msg =[
    'type'=>'sms',
    'data'=>[
        'ext'=>'',
        'extend'=>'',
        'sign'=>'SPARTAN',
        'params'=>[
            '王浩',
            '公开组',
            '11:00',
        ],
        'tel'=>[
            'mobile'=>'13521011812',
            'nationcode'=>'86',
        ],
        'tpl_id'=>375899
    ]
];

$topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($msg), $key);
$rk->poll(0);

while ($len =$rk->getOutQLen() > 0) {
    $rk->poll(50);
}