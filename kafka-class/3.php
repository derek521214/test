<?php

// 一致性哈希算法
class ConsistentHashing {
    protected $nodes = [];
    protected $position = [];
    protected $mul = 64;  // 每个节点对应64个虚拟节点


    public function __construct($nodes=[]){
        if (!empty($nodes)) {
            foreach ($nodes as $node) {
                $this->addNode($node);
            }
        }
    }

    /**
     * 把字符串转为32位符号整数
     */
    public function hash($str) {
//        $str =md5($str);
        return sprintf('%u', crc32($str));
    }

    /**
     * 核心功能
     */
    public function lookup($key) {
        $point = $this->hash($key);

        //先取圆环上最小的一个节点,当成结果
        $node = current($this->position);
        // 循环获取相近的节点
        foreach ($this->position as $key => $val) {
            if ($point <= $key) {
                $node = $val;
                break;
            }
        }
        reset($this->position);
        return $node;
    }

    /**
     * 添加节点
     */
    public function addNode($node) {
        if(isset($this->nodes[$node])){
            return;
        }
        // 添加节点和虚拟节点
        for ($i = 0; $i < $this->mul; $i++) {
            $pos = $this->hash($node . '-' . $i);
            $this->position[$pos] = $node;
            $this->nodes[$node][] = $pos;
        }

        // 重新排序
        $this->sortPos();
    }

    /**
     * 删除节点
     */
    public function delNode($node) {
        if (!isset($this->nodes[$node])){
            return;
        }
        // 循环删除虚拟节点
        foreach ($this->nodes[$node] as $val) {
            unset($this->position[$val]);
        }
        // 删除节点
        unset($this->nodes[$node]);
    }

    /**
     * 排序
     */
    public function sortPos() {
        ksort($this->position, SORT_REGULAR);
    }
}


// 测试
$con = new ConsistentHashing();

$con->addNode('spartan-sms-0');
$con->addNode('spartan-sms-1');
$con->addNode('spartan-sms-2');
//$con->addNode('spartan-sms-3');

$key1 = '13388649683';
$key2 = '17771641842';
$key3 = '18921011612';
$key4 = '15971165645';

echo 'key' . $key1 . '落在' . $con->lookup($key1) . "号节点上！".PHP_EOL;
echo 'key' . $key2 . '落在' . $con->lookup($key2) . "号节点上！".PHP_EOL;
echo 'key' . $key3 . '落在' . $con->lookup($key3) . "号节点上！".PHP_EOL;
echo 'key' . $key4 . '落在' . $con->lookup($key4) . "号节点上！".PHP_EOL;