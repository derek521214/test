<?php
$txt = <<<EOT
<xml>
<ToUserName><![CDATA[gh_e3b5b992989e]]></ToUserName>
<FromUserName><![CDATA[oSIFp1CB_8g6v84NMZDSNIuK7-_E]]></FromUserName>
<CreateTime>1583726673</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[1234test]]></Content>
<MsgId>22673513993248140</MsgId>
</xml>
EOT;


//$xmlObj = simplexml_load_string($txt,'SimpleXMLElement');
$xmlObj = simplexml_load_string($txt,'SimpleXMLElement',LIBXML_NOCDATA);

//var_dump($xmlObj);

        $toUserName = $xmlObj->ToUserName; // 开发者微信账号
        $fromUserName = $xmlObj->FromUserName; // 发送方账号
        $createTime = $xmlObj->CreateTime; // 消息创建时间
        $msgType = $xmlObj->MsgType; // 消息类型

//echo  $xmlObj->Content;
if ($xmlObj->Content == '1234test') {
    echo 111;
} else {
    echo 000;
}