<?php

namespace frontend\assets;

use nodge\eauth\assets\WidgetAssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EauthAsset extends WidgetAssetBundle
{
    public $css = [

    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
