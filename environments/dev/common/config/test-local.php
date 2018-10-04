<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=teachme.com;dbname=teachme',
                'username' => 'dbuser',
                'password' => '2222',
                'charset' => 'utf8',
            ],
        ],
    ]
);
