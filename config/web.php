<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'avtotools/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jz2pjysdfdsb_yqjYZlY381N6EQR_3Q-Zyigw',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
 //               '' => 'home/index',
//                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//                'category/search' => 'category/search',
//                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
//                'catalog' => 'catalog/index',
//                'catalog/toggle' => 'catalog/toggle',
//                'catalog/search' => 'catalog/search',
//                'catalog/<slug:.+>' => 'catalog/view',
//                'my-account' => 'my-info',
//                'my-info' => 'my-info',
//                'order' => 'order',
//
////                'admin/yii2images/images/image-by-item-and-alias' => 'yii2images/images/image-by-item-and-alias',
//                'admin/yii2images/images/image-by-item-and-alias' => 'yii2images/images/image-by-item-and-alias',
//                'product/<slug:.+>' => 'product/view',
//                'post/<slug:.+>' => 'post/view',
//                'page/<slug:.+>' => 'page/view',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
