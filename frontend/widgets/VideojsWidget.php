<?php

namespace frontend\widgets;

use Yii;

/**
 * Class VideojsWidget
 * @package kato
 */
class VideojsWidget extends \kato\VideojsWidget 
{
    private function registerAssets()
    {
        $view = $this->getView();

        $asset = VideojsAsset::register($view);
        $asset->multipleResolutions = $this->multipleResolutions;

        //if (!is_null($this->jsOptions)) {
            $js = 'var player = videojs("#' . $this->options['id'] . '").ready(' . $this->jsOptions . ');';
            $js = "alert('hui')";
            $view->registerJs($js);
        //}
    }
}