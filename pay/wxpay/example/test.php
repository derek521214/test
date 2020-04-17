<?php
/**
 *
 * example目录下为简单的支付样例，仅能用于搭建快速体验微信支付使用
 * 样例的作用仅限于指导如何使用sdk，在安全上面仅做了简单处理， 复制使用样例代码时请慎重
 * 请勿直接直接使用样例对外提供服务
 *
 **/

require_once \Yii::getAlias("@common") . "/vendor/pay/wxpay/lib/WxPay.Api.php";
require_once \Yii::getAlias("@common") . "/vendor/pay/wxpay/example/WxPay.JsApiPay.php";
require_once \Yii::getAlias("@common") . "/vendor/pay/wxpay/example/WxPay.Config.php";

