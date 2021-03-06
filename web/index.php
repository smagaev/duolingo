<?php

// comment out the following two lines when deployed to production
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

function debug($var){
    return  "<pre>" . print_r($var) . "</pre>";
}
(new yii\web\Application($config))->run();
