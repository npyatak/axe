<?php
use yii\helpers\Url;
?>
<div class="reg_screen_block">
    <p>
        <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'rules' => isset($rules) ? $rules : null, 'ref' => isset($ref) ? $ref : null]);?>
    </p>
    <div class="reg_screen_check">
        <input type="checkbox" id="register_checkbox" checked>
        <label for="register_checkbox">Я соглашаюсь <a href="#<?=isset($rules) ? 'rules-'.$rules : 'full-rules';?>" class="fancybox">с полными правилами</a> конкурса</label>
    </div>
</div>