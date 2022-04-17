<?php

if (YII_ENV_DEV !== true) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost; dbname=srv68348_duolingo; port=3306',
        'username' => 'srv68348_adtox',
        'password' => 'adtox@2021',
        'charset' => 'utf8',
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost; dbname=duolingo; port=3306',
        'username' => 'root',
        'password' => 'password',
        'charset' => 'utf8',
    ];
}
