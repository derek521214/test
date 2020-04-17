<?php
$config = array (	
    //应用ID,您的APPID。
    'app_id' => "2018112662314700",

    //商户私钥
    'merchant_private_key' => 'MIIEowIBAAKCAQEAr57p77k6jyI31nBSpdPE5hYAqzAln48/EaPFKifr0NjrppFifGn57J2RcSxu40THJXt8o5knxmbhCpB/Y2prYccF/+oAJBjx1He6XfhHMXPUs+WB6TqZBshMqlQNPoTr5HqDCwPIEOU9Hr2Ay55rD073UKul9BT6DRlNF6YMP9wQFJAjPFJbVX3e70aPP6bBVcqwudtJYBXKhfzhnfUr9utpw1DwOddjJNheSDp05aHmiP/eh3/TbT/Uez7AmpWB3HabpkdLgBiaOO/nQ5l/h67F81cQ0wh+++9DpIEJTfRS5MU2sqQxJz2uYji3r5KU30Z3T3F6UKLMO+s0GYupuQIDAQABAoIBAQCU9+CJ9v3kQetJW5fPj/WaEhnZHAsd8J1X8iohmyFd01L4xKPc0uwruHCRplYdM88VTU0pXJWvpr7HflCAXNnfY7oEHVKnS/19811DroF9QjqvqkNrOchqR2c4p/lgCdIqyXz0z+1Z34nb1HU2wxcfMiV46VDo3Q5KJCcPo0sKstG9LjaaLefCcrM4VPXb9G1GWu81QHlar5uzmljj8fUKwwaYDGtDZeLRlmIDCbHKR24A6LQUfLVbactevJuVO/cluinaivIHDh+UhSpwzi+n752IhsJPk/5dF+UHIoYFUZ4wfuRUVHSaT9od+3Em9dHdcbGe0YO5Gb1cgg9ynsCtAoGBANQkNChMqtTd4VWWeV0iZtY49PNZecGxQFo07I+si9+xaonO06aHHBh8Qks5pk6N6DQhTCb3IoJ55LWHH42Cz2ENbNgyhSCEszkUk6JQ95GACpuIhZZXzrgptWf8bT5rRihLNtgb2AV/EhNnplxz1mYvEzsOnPBU1ZOE7Kv4rnuHAoGBANPt0Uk04nKDCgOhKicUtxZPIpKXCjhIH2O/m6hkeoxuNjv90Ilo+L2W6TwH5esFOFbjGu9ZSMrLnj/5W6FdzPN7h0ylxTa9HdBZ79fkDfxHAEYjmrArkzwe9X7N9xkAegxvp4AHrYUBYdGdMAwBiVRY5j9laYdXkbZ6WSesFoC/AoGANW3w3P2CQR6o9B9z7asOb4Hk3613Zvs3lACkXAM/L1XF2XOIBvcccmZJZBze8AX5p7eDMIUp4ebFXZrsrX12saDp+wGuWeRSJ1wxWr49vB2djlKyIo12+Rc4IzqGYSQvhVJ8O623mJrKeKywT7S1GQNeOo+Ro04ahI8D9MQrXd0CgYBbpn9Zv2smxpCwHSSTnhvHpBV5e6RJzrb0dkqkuj9dN9RwgUWMBz97DiZzdZ7y0mEZAkIFvIEEYqZfWEFOObiGm6dZeF8fWw3nqt1UaiW6MiJmMsOU6GNWHrVgT0ZLI6+kbSzs62UZHg3ljqrWpltzhLaeOAc5Jp+3YJXp2DwrFQKBgD6lZHndE/3YPV/luwRlKVjqmRD5kFFvo7+T9lYHNe2ViZ9I/QIyPP5LC3BSjwUZ0+LpOa934Kk4geIgcwaPtSkE9cpDJxBPuKa5Qie1POcFsWdbxpyCE/TQIxiIbK5ttd+xyq2aasoN3HTSFxe3S+HDev1iaJAFwLXkriEtvJzX',//dirname ( __FILE__ ).'/key/rsa_private_key.pem',

    //异步通知地址
    'notify_url' => SITE_URL."/order/notify",

    //同步跳转
    'return_url' => SITE_URL."/order/return",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv5n/yJ5skGstbOdFEsn+uRwtHuxLo5C65fePMoVGQLhQ0MPM5oEACIZh9vmAz9yO+OGYiMJxIoUIzjeS6PUz7DOlXV8ppdGjHyzT8LTMzhZ1vCwXtguGAaT/m5OnJOR4gLKJIC0xKYZZpir9khl3tG3N5gFQi68In1IeBL9d5FcXq4VwWReoBS+bhi3vzVlKDhayjhk8pydgpKC/OIUBVlAenjuGH+s+QLdyjWbaATTcgXHt9q2Yums883qop0Yw68FBAQaAkk72oXWIvIt+aq1FC+etibkbwkGl71UHGkrqsvJMzRijdYGVjnc+R3zW9oGvSVbswD/70W/yaQtybwIDAQAB',
    //dirname ( __FILE__ ).'/key/rsa_public_key.pem',
);