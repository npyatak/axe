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
<<<<<<< HEAD
        'js/shooting.js?v=25012018_1',
=======
        'js/shooting.js?v=25012018_2',
>>>>>>> 7e71fd502623784d02c515321b9a96b001ef725c
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
