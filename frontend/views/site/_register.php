<?php
use yii\helpers\Url;
?>
<div class="reg_screen_block">
    <p>
        <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'rules' => isset($rules) ? $rules : null]);?>
    </p>
    <div class="reg_screen_check">
        <input type="checkbox" id="register_checkbox" checked>
        <label for="register_checkbox">Я соглашаюсь <a href="#full-rules" class="fancybox">с полными правилами</a> конкурса</label>
    </div>
</div>