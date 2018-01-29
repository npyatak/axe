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
        'css/shooting.css?v=25012018_1',
    ];
    public $js = [
        'js/shooting.js?v=25012018_1',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
