<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'cache' => [
            'class' => 'yii\redis\Cache'
        ],
//        'redis' => [
//            'class' => 'heyanlong\redis\Connection',
//            'master' => [
//                '112.74.185.109:7000',
//                '112.74.185.109:7001',
//                '112.74.185.109:7002',
//            ],
//            'database' => 0,
//            'password' => '123456',
//        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '112.74.185.109',
            'port' => 7001,
            'password' => '123456',
            'database'=>0,
        ]
//        'redis' => [
//            'class' => 'yii\redis\Connection',
////            'hostname' => '112.74.185.109',
////            'port' => 7000,
////            'password' => '123456',
////            'database'=>0,
//
//            'servers'=>[
//            [
//                'hostname' => '112.74.185.109',
//                'port' => 7001,
//                'password' => '',
//                'database'=>0
//            ],
//           [
//                'hostname' => '112.74.185.109',
//                'port' => 7002,
//                'password' => '',
//                'database'=>0
//            ],
////            array(
////                'hostname' => '112.74.185.109',
////                'port' => 7003,
////                'password' => '',
////                'database'=>0
////            ),
////            array(
////                'hostname' => '112.74.185.109',
////                'port' => 7004,
////                'password' => '',
////                'database'=>0
////            ),
////            array(
////                'hostname' => '112.74.185.109',
////                'port' => 7005,
////                'password' => '',
////                'database'=>0
////            ),
//            ]
//        ]
    ],
    'language' => 'zh-CN',
    'homeUrl'  => '/index.php?r=site/index'
];
