<?php

$arr = [
    'button'=>[
        [
            'name'=>'赛事详情',
            'sub_button'=>[
                [
                    'type'=>'view',
                    'name'=>'赛事简介',
                    'url'=>'https://mp.weixin.qq.com/mp/homepage?__biz=MzU2MzY4NDE2OA==&hid=1&sn=a28a42ab5a5da2399aa76c414481e748',
                ],
                [
                    'type'=>'view',
                    'name'=>'赛事报名',
                    'url'=>'http://spartan.zhibo.tv',
                ],
                [
                    'type'=>'click',
                    'name'=>'成绩照片',
                    'key'=>'ACHIEVEMENT_PICTURE',
                ],
                [
                    'type'=>'view',
                    'name'=>'完赛证书',
                    'url'=>'http://spartanrace.zhibo.tv/warrior',
                ],
                [
                    'type'=>'click',
                    'name'=>'勇士热线',
                    'key'=>'WARRIOR_HOTLINE',
                ],
            ]
        ],
        [
            'name'=>'训练',
            'sub_button'=>[
                [
                    'type'=>'view',
                    'name'=>'训练计划',
                    'url'=>'https://mp.weixin.qq.com/s/KeBWpVkdx8WiRyvTFSSKew',
                ],
                [
                    'type'=>'view',
                    'name'=>'训练营报名',
                    'url'=>'http://spartan.zhibo.tv',
                ],
            ]
        ],
        [
            'type'=>'miniprogram',
            'name'=>'勇士商城',
            'url'=>'http://mp.weixin.qq.com',
            'appid'=>'wx96d41d1bf61c18ee',
            'pagepath'=>'pages/index/index',
        ],
    ]

];


echo json_encode($arr);die();