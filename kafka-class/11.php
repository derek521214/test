<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2019/9/15
 * Time: 19:14
 */


require './Producer.php';

$rk = new rdkafka\kafka\Producer(['172.23.75.209:9092']);

$rk->setProducerTopic('spartan-wechat-message-0');


$jsonData = <<<JSON
{
   "touser":"oSIFp1CB_8g6v84NMZDSNIuK7-_E",
   "template_id":"eo3TZnNXJxQNDV_ECN0hMGve0vN5naGX2VMqAYR4Ifc",
   "url":"",  
   "miniprogram":{
	 "appid":"",
	 "pagepath":""
   },     
   "data":{
		   "first": {
			   "value":"恭喜您报名成功！",
			   "color":"#173177"
		   },
		   "keyword1":{
			   "value":"斯巴达勇士障碍赛",
			   "color":"#173177"
		   },
		   "keyword2": {
			   "value":"2019-12-01 11:00",
			   "color":"#173177"
		   },
		   "keyword3": {
			   "value":"北京奥林匹克森林公园",
			   "color":"#173177"
		   },
		   "remark":{
			   "value":"点击查看详情！",
			   "color":"#173177"
		   }
   }
}
JSON;


$key = 'wechat-message';
$msg =[
    'type'=>'wechat-message',
    'data'=>[
        'access_token'=>'28_xApCmU6FD7vxe6ydazj61yMhWuo_V-xHmYKJS20L7jB2hWwbfl7RSUjxtz4u4YA8A_U2izEKvkzHQ8vgzIQT_ifYAqmDCslctWbh52xdEi7Q9ah58yY-OpPFQPOyUoI7Owqznhazi91ebovBLJMeACAPNQ',
        'post_data'=>$jsonData,
    ]
];


for ($i=0;$i<5;$i++) {
    try {
        $rk->producer(json_encode($msg), $key);
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
}




//$rk->setProducerTopic('spartan-sms-1');
//
//for ($i=0;$i<10;$i++) {
//    $rk->producer(json_encode($msg), $key);
//}

