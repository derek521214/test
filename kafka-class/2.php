<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 19:14
 */


require './Consumer.php';

$rk = new rdkafka\kafka\Consumer(['172.23.75.209:9092']);

$rk->setGroupId('myConsumerGroup2');

$rk->subscribe(['sun']);

$rk->consumer();
