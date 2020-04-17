<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 17:03
 */

namespace  rdkafka\kafka;


class Consumer
{
    protected $kafkaConsumer;

    protected $conf;

    protected $topicConf;

    public function __construct(array $brokers)
    {
        $this->conf = new \RdKafka\Conf();

        $this->conf->setRebalanceCb(function (\RdKafka\KafkaConsumer $kafka, $err, array $partitions = null) {
            switch ($err) {
                case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
                    echo "Assign: ";
                    $kafka->assign($partitions);
                    break;
                case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
                    echo "Revoke: ";
                    $kafka->assign(NULL);
                    break;

                default:
                    throw new \Exception($err);
            }
        });

        $this->setBrokerList($brokers);
        $this->setTopicConf();
    }

    /**
     * 设置 topic 配置
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:19:00
     */
    protected function setTopicConf()
    {
        $this->topicConf = new \RdKafka\TopicConf();

        $this->topicConf->set('request.required.acks', -1);

        //在interval.ms的时间内自动提交确认、建议不要启动
        $this->topicConf->set('auto.commit.enable', 0);

        $this->topicConf->set('auto.commit.interval.ms', 100);

        // 设置offset的存储为broker
        $this->topicConf->set('offset.store.method', 'broker');

        // Set where to start consuming messages when there is no initial offset in
        // offset store or the desired offset is out of range.
        // 'smallest': start from the beginning
        //$topicConf->set('auto.offset.reset', 'smallest');
        $this->topicConf->set('auto.offset.reset', 'smallest');
    }

    /**
     * 设置 消费组ID
     * @param $groupId
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:58
     */
    public function setGroupId($groupId)
    {
        $this->conf->set('group.id', $groupId);
    }

    /**
     *
     * @param array $brokers
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:18:57
     */
    protected function setBrokerList(array $brokers)
    {
        $brokerList = implode(',', $brokers);
        $this->conf->set('metadata.broker.list', $brokerList);
    }

    /**
     * 订阅 topic
     * @param $topicNames
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:19:08
     */
    public function subscribe($topicNames)
    {
        $this->conf->setDefaultTopicConf($this->topicConf);
        $this->kafkaConsumer = new \RdKafka\KafkaConsumer($this->conf);

// Subscribe to topic 'test'
        $this->kafkaConsumer->subscribe($topicNames);
    }

    /**
     * 开始消费 成功返回信息
     * @throws \Exception
     * @Author 王浩
     * @Date:2019/9/16
     * @Time:10:12
     */
    public function consumer()
    {
        while (true) {
            $message = $this->kafkaConsumer->consume(120*1000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    $this->getMessage($message);
                    $this->kafkaConsumer->commit($message);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; will wait for more\n";
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Time out\n";
                    break;
                default:
                    throw new \Exception($message->errstr(), $message->err);
                    break;
            }
        }
    }

    public function getMessage($message)
    {
        var_dump($message);
    }

}

