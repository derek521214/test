<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/12
 * Time: 14:14
 */

$conf = new RdKafka\Conf();

// Set the group id. This is required when storing offsets on the broker
$conf->set('group.id', 'myConsumerGroup');

$rk = new RdKafka\Consumer($conf);
$rk->addBrokers("172.23.75.209:9092");

$queue = $rk->newQueue();

$topicConf = new RdKafka\TopicConf();
$topicConf->set('auto.commit.interval.ms', 100);

// Set the offset store method to 'file'
$topicConf->set('offset.store.method', 'broker');

// Alternatively, set the offset store method to 'none'
// $topicConf->set('offset.store.method', 'none');

// Set where to start consuming messages when there is no initial offset in
// offset store or the desired offset is out of range.
// 'smallest': start from the beginning
$topicConf->set('auto.offset.reset', 'smallest');


$topic1 = $rk->newTopic("sun", $topicConf);
$topic1->consumeQueueStart(0, RD_KAFKA_OFFSET_BEGINNING, $queue);
$topic1->consumeQueueStart(1, RD_KAFKA_OFFSET_BEGINNING, $queue);

$topic2 = $rk->newTopic("sun1", $topicConf);
$topic2->consumeQueueStart(0, RD_KAFKA_OFFSET_BEGINNING, $queue);


while (true) {
    $message = $queue->consume(120*1000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            var_dump($message);
            if ($message->topic_name == 'sun') {
                $topic1->offsetStore($message->partition, $message->offset);
            }

            if ($message->topic_name == 'sun1') {
                $topic2->offsetStore($message->partition, $message->offset);
            }
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
            break;
    }
}

