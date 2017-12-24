<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['parser', 'googleApi'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/info.log',
                ],
            ],
        ],
        'googleApi' => [
            'class'                 => '\skeeks\yii2\googleApi\GoogleApiComponent',
            'developer_key'         => 'AIzaSyCq5RWFKZeOtVFEQkqjYmvv7EATTqtsaSw',
        ],
    ],
    'params' => $params,
];
