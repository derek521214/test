<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/12
 * Time: 14:14
 */

$conf = new RdKafka\Conf();

// Set a rebalance callback to log partition assignments (optional)
$conf->setRebalanceCb(function (RdKafka\KafkaConsumer $kafka, $err, array $partitions = null) {
    switch ($err) {
        case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
            echo "Assign: ";
            var_dump($partitions);
            $kafka->assign($partitions);
            break;

        case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
            echo "Revoke: ";
            var_dump($partitions);
            $kafka->assign(NULL);
            break;

        default:
            throw new \Exception($err);
    }
});

// Configure the group.id. All consumer with the same group.id will consume
// different partitions.
$conf->set('group.id', 'myConsumerGroup2');

// Initial list of Kafka brokers
$conf->set('metadata.broker.list', '172.23.75.209:9092,172.23.75.209:9092');

$topicConf = new RdKafka\TopicConf();

// Set where to start consuming messages when there is no initial offset in
// offset store or the desired offset is out of range.
// 'smallest': start from the beginning
//$topicConf->set('auto.offset.reset', 'smallest');

$topicConf->set('request.required.acks', -1);

//在interval.ms的时间内自动提交确认、建议不要启动
$topicConf->set('auto.commit.enable', 0);
//$topicConf->set('auto.commit.enable', 0);
$topicConf->set('auto.commit.interval.ms', 100);

// 设置offset的存储为file
//$topicConf->set('offset.store.method', 'file');
//$topicConf->set('offset.store.path', __DIR__);
// 设置offset的存储为broker
 $topicConf->set('offset.store.method', 'broker');

$topicConf->set('auto.offset.reset', 'smallest');

// Set the configuration to use for subscribed/assigned topics
$conf->setDefaultTopicConf($topicConf);

$consumer = new RdKafka\KafkaConsumer($conf);

// Subscribe to topic 'test'
$consumer->subscribe(['sun']);

echo "Waiting for partition assignment... (make take some time when\n";
echo "quickly re-joining the group after leaving it.)\n";

while (true) {
    $message = $consumer->consume(120*1000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            echo $message->partition . ' ';
            echo $message->payload . ' ';
            echo $message->key . ' ';
            echo date('H:i:s',$message->timestamp) . ' ';
            echo $message->offset . PHP_EOL;
            $consumer->commit($message);
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
