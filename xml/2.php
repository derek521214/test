<?php
function data2xml(&$xml, $data, $item = 'item') {
    foreach ($data as $key => $value) {
        /* 指定默认的数字key */
        is_numeric($key) && $key = $item;
        /* 添加子元素 */
        if(is_array($value) || is_object($value)){
            $child = $xml->addChild($key);
            data2xml($child, $value, $item);
        } else {
            if(is_numeric($value)){
                $child = $xml->addChild($key, $value);
            } else {
                $child = $xml->addChild($key);
                $node  = dom_import_simplexml($child);
                $cdata = $node->ownerDocument->createCDATASection($value);
                $node->appendChild($cdata);
            }
        }
    }
}
$data = [
    'ToUserName'   => 'adddsd',
    'FromUserName' => '123adddsd',
    'CreateTime'   => time(),
    'MsgType'      => 'image',
    'ArticleCount'      => 2,
    'Articles'      =>[
        [
            'Title'=>'test'
        ],
        [
            'Title'=>'test1'
        ]
    ],
];


$xml = new \SimpleXMLElement('<xml></xml>');
data2xml($xml, $data);

$xmlStr = $xml->asXML();
$xmlStr = str_replace('<?xml version="1.0"?>','',$xmlStr);
echo str_replace("\n",'',$xmlStr);