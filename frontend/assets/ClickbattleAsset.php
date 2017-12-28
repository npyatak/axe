<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ClickbattleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css',
        'css/libs.min.css?v=27122017_1',
        'css/main_clicker.css',
        'css/site.css?v=27122017_1',
    ];
    public $js = [
        'js/libs.min.js?v=27122017_1',
        'js/common.js?v=27122017_1',
        'js/phaser.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
