<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 17:03
 */

namespace  rdkafka\kafka;


use mysql_xdevapi\Exception;

class Producer
{

    protected $producer;

    protected $conf;

    protected $topicConf;

    protected $topic;

    public function __construct(array $brokers)
    {
        $this->conf = new \RdKafka\Conf();

        $this->conf->setDrMsgCb(function ($kafka, $message) {
            $this->saveMsgLog($message);
        });

        $this->conf->setErrorCb(function ($kafka, $err, $reason) {
            $this->saveErrorLog($err, $reason);
            throw new \Exception(sprintf("Kafka error: %s (reason: %s)", rd_kafka_err2str($err), $reason));
        });
        // 设置brokerlist
        $this->setBrokerServer($brokers);

    }

    /**
     * 保存消息日志
     * @param $message
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:16
     */
    protected function saveMsgLog($message)
    {
        file_put_contents("./dr_cb.log", var_export($message, true).PHP_EOL, FILE_APPEND);
    }

    /**
     * 保存错误日志
     * @param $err
     * @param $reason
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:18
     */
    protected function saveErrorLog($err, $reason)
    {
        file_put_contents("./err_cb.log", sprintf("Kafka error: %s (reason: %s)", rd_kafka_err2str($err), $reason).PHP_EOL, FILE_APPEND);
    }

    /**
     * 设置代理(broker)
     * 设置brokerlist
     * @param array $brokers
     * @Author 王浩
     * @Date:2019/9/15s
     * @Time:18:27
     */
    protected function setBrokerServer(array $brokers)
    {

        try {
            $this->producer = new \RdKafka\Producer($this->conf);
//            $this->producer->setLogLevel(LOG_DEBUG);
            $brokerList = implode(',', $brokers);
            $this->producer->addBrokers($brokerList);
        } catch (\RdKafka\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());die();
        }
    }

    /**
     * 设置主题(topic)
     * @param $topicName
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:33
     */
    public function setProducerTopic($topicName)
    {
        try {
            $this->topicConf = new \Rdkafka\TopicConf();
            // -1必须等所有brokers确认 1当前服务器确认 0不确认，这里如果是0回调里的offset无返回，如果是1和-1会返回offset
            $this->topicConf->set('request.required.acks', -1);
            $this->topic = $this->producer->newTopic($topicName, $this->topicConf);
        } catch (\RdKafka\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());die();
        }
    }

    /**
     * @param $message
     * @param $key
     * @return bool
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:33
     */
    public function producer($message, $key)
    {
        try {
            $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, $message, $key);
            $len = $this->producer->getOutQLen();
            while ($len > 0) {
                $len = $this->producer->getOutQLen();
                $this->producer->poll(0);
            }
        } catch (\RdKafka\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());die();
        }
        return true;
    }


}