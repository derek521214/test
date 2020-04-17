<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/11
 * Time: 18:16
 */

//$conf = new Rdkafka\Producer();
//$producer = new RdKafka\Producer();
class kafka
{
    public $broker_list="172.23.75.209:9092";
    public $topic = "sun";
    public $partion = 0;
    protected $producer = null;
    protected $consumer = null;
    public function __construct()
    {
        $rk = new RdKafka\Producer();
        if(empty($rk))
        {
            throw new \Exception("producer error");
        }
        $rk->setLogLevel(LOG_DEBUG);
        if(!$rk->addBrokers($this->broker_list))
        {
            throw new \Exception('添加broker失败');
        }
        $this->producer=$rk;
    }
    public function sendmsg($array_message="")
    {
        /*$topic = $this->producer->newTopic($this->topic);
        return $topic->produce(RD_KAFKA_PARTITION_UA,$this->partion,json_encode($array_message));*/
        $topic = $this->producer->newTopic($this->topic);
        return $topic->produce(RD_KAFKA_PARTITION_UA,$this->partion,$array_message);
    }
}

$kafuka = new Kafka();
$kafuka->sendmsg('general! welcome to distributed world!');
$kafuka->sendmsg('好好学编程，泡昌仔和劲儿弟弟!');