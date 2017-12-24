<?php
use yii\helpers\Url;
?>
<div class="reg_screen_block">
    <p>	
    	<a href="<?=Url::toRoute(['site/login', 'service' => 'fb', 'ref' => Url::current(), 'rules' => isset($rules) ? $rules : '']);?>" class="soc_lnk eauth-service-link fb"  data-eauth-service="facebook" data-event="test_way" data-param="registration_fb">
    		<i class="zmdi zmdi-facebook"></i>
    	</a> 
    	или 
    	<a href="<?=Url::toRoute(['site/login', 'service' => 'vk', 'ref' => Url::current(), 'rules' => isset($rules) ? $rules : '']);?>" class="soc_lnk eauth-service-link vk"  data-eauth-service="vkontakte" data-event="test_way" data-param="registration_vk">
    		<i class="zmdi zmdi-vk"></i>
    	</a>
    </p>
    <div class="reg_screen_check">
        <input type="checkbox" id="register_checkbox" checked>
        <label for="register_checkbox">Я соглашаюсь <a href="#full-rules" class="fancybox">с полными правилами</a> конкурса</label>
    </div>
</div>