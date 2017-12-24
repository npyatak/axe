<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $id string */
/** @var $services stdClass[] See EAuth::getServices() */
/** @var $action string */
/** @var $popup bool */
/** @var $assetBundle string Alias to AssetBundle */

Yii::createObject(['class' => $assetBundle])->register($this);

// Open the authorization dilalog in popup window.
if ($popup) {
	$options = [];
	foreach ($services as $name => $service) {
		$options[$service->id] = $service->jsArguments;
	}
	$this->registerJs('$("#' . $id . '").eauth(' . json_encode($options) . ');');
}

?>
<div class="eauth" id="<?php echo $id; ?>">
	<?php if($location == 'profile'):?>
	    <a href="<?=Url::toRoute(['site/login', 'service' => 'fb']);?>" class="soc_lnk eauth-service-link fb"  data-eauth-service="facebook" data-event="login" data-param="login_fb">
	        <i class="zmdi zmdi-facebook"></i>
	    </a> 
	    <a href="<?=Url::toRoute(['site/login', 'service' => 'vk']);?>" class="soc_lnk eauth-service-link vk"  data-eauth-service="vkontakte" data-event="login" data-param="login_vk">
	        <i class="zmdi zmdi-vk"></i>
	    </a>
	<?php else:?>
		<a href="<?=Url::toRoute(['site/login', 'service' => 'fb', 'ref' => Url::current(), 'rules' => isset($rules) ? $rules : '']);?>" class="soc_lnk eauth-service-link fb"  data-eauth-service="facebook" data-event="test_way" data-param="registration_fb">
			<i class="zmdi zmdi-facebook"></i>
		</a> 
		<a href="<?=Url::toRoute(['site/login', 'service' => 'vk', 'ref' => Url::current(), 'rules' => isset($rules) ? $rules : '']);?>" class="soc_lnk eauth-service-link vk"  data-eauth-service="vkontakte" data-event="test_way" data-param="registration_vk">
			<i class="zmdi zmdi-vk"></i>
		</a>
	<?php endif;?>
</div>