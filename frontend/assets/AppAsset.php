<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css',
        'css/libs.min.css?v=23012018_1',
        'css/main.css?v=23012018_1',
        'css/site.css?v=23012018_1',
    ];
    public $js = [
        'js/libs.min.js?v=23012018_1',
        'js/common.js?v=23012018_1',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
