<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 16:59
 */
namespace  rdkafka\kafka;

class Kafka
{
    protected $conf;

    protected $consumer;

    protected $topicConf;

    /**
     * @param $kafkaName
     * @param $conf
     * @Author 王浩
     * @Date:2019/9/15
     * @Time:17:54
     */
    protected function getKafka($kafkaName, $conf=null)
    {
        if (!$this->$kafkaName instanceof  RdKafka) {
            $kafkaName = ucfirst($kafkaName);
            $name = 'RdKafka\\'.$kafkaName;
            if ($conf instanceof Rdkafka) {
                $this->$kafkaName = new $name($conf);
                var_dump($this->$kafkaName);die();
            } else {
                $this->$kafkaName = new $name();
                var_dump($this->$kafkaName);die();
            }
        }
    }


}