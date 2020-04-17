<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/12
 * Time: 14:22
 */

$rk = new RdKafka\Producer();
$rk->addBrokers("172.23.75.209:9092");

$topic = $rk->newTopic("sun");

for ($i = 0; $i < 10; $i++) {
    $topic->produce($i, 0, "Message $i",$i);
    $rk->poll(0);
}

while ($rk->getOutQLen() > 0) {
    $rk->poll(50);
}