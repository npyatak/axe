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
        'css/libs.min.css?v=11022018_2',
        'css/main_clicker.css?v=11022018_2',
        'css/site.css?v=11022018_2',
    ];
    public $js = [
        'js/libs.min.js?v=11022018_2',
        'js/common.js?v=11022018_2',
        'js/phaser.min.js?v=11022018_2',
        'js/clickbattle.js?v=11022018_2',
        'js/js.cookie.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
