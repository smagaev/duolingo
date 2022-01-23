<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'my_app',
    'name' => 'Duolingo Words',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'languageSwitcher'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
//            'baseUrl' => 'http://duolingo',
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
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'smagaev@mail.ru',
                'password' => "s'#19700322#'s",
                'port' => '465',
                'encryption' => 'tls',
            ],
            'useFileTransport' => true,
        ],

        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                '/' => 'home/index',
//                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'basePath' => '@app/messages',
                        'sourceLanguage' => ['ru-RU','en-US'],
                        'app' => 'app.php',
                        'app/error' => 'error.php',

                    ],
                ],
            ],
        ],
        'languageSwitcher' => [
            'class' => 'app\components\languageSwitcher',
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
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
