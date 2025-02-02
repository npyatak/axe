<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ShootingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/shooting.css?v=11022018_2',
    ];
    public $js = [
        'js/shooting.js?v=11022018_2',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
