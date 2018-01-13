<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'Открой для себя мир киберспорта вместе с Axe',
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '/',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => '23465687409',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true, 'expire' => 3600 * 24 * 365],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => ['/js/jquery-1.12.2.min.js'],
                ],
            ]
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'name' => 'advanced-frontend',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 24 * 365],
            'timeout' => 3600 * 24 * 365, //session expire
            'useCookies' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => ['nodge\eauth\*'],
                    'logVars' => [],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => [
                'fb' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'frontend\models\social\FbOAuth2Service',
                    'clientId' => '706435896217940',
                    'clientSecret' => 'cd43f0276a3baa5aed62dbd3b4dfbf7f',
                ],
                'vk' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'frontend\models\social\VkOAuth2Service',
                    'clientId' => '6299457',
                    'clientSecret' => 'YhumZ8iFQtpPisFhiVb8',
                ],
                'go' => [
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'frontend\models\social\GoOAuth2Service',
                    'clientId' => '608347128309-l8f905qpjorb9gpo8k8po24e9ckqk0hd.apps.googleusercontent.com',
                    'clientSecret' => 'nLszf2a287Ve9PB-FpZLajNI',
                    'title' => 'Google',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
            'rules' => [
                '' => 'site/index',                
                '<controller:\w+>'=>'<controller>/index',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action>/<id:\d+>' => '<controller>/<action>',
                
                // '<action:\w+>/<id:\d+>' => 'site/<action>',
                
                //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                //'<controller:\w+>/<action>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
