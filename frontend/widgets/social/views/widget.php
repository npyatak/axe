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

<?php $arr = [];
if($ref) {
	$arr['ref'] = $ref;
} else {
	$arr['ref'] = Url::current();
}
if($rules) {
	$arr['rules'] = $rules;
}
?>

<<?=$wrapper;?> class="<?=$wrapperClass;?>" id="<?php echo $id; ?>">
	<?=$wrapper == 'ul' ? '<li>' : '';?>
	    <a href="<?=Url::toRoute(['site/login', 'service' => 'fb'] + $arr);?>" class="soc_lnk eauth-service-link fb"  data-eauth-service="facebook" data-event="<?=$location == 'profile' ? 'login' : 'test_way';?>" data-param="<?=$location == 'profile' ? 'login_fb' : 'registration_fb';?>">
	        <i class="zmdi zmdi-facebook"></i>
	    </a> 
	<?=$wrapper == 'ul' ? '</li>' : '';?>
	<?=$wrapper == 'ul' ? '<li>' : '';?>
	    <a href="<?=Url::toRoute(['site/login', 'service' => 'vk'] + $arr);?>" class="soc_lnk eauth-service-link vk"  data-eauth-service="vkontakte" data-event="<?=$location == 'profile' ? 'login' : 'test_way';?>" data-param="<?=$location == 'profile' ? 'login_vk' : 'registration_vk';?>">
	        <i class="zmdi zmdi-vk"></i>
	    </a>
	<?=$wrapper == 'ul' ? '</li>' : '';?>
	<?=$wrapper == 'ul' ? '<li>' : '';?>
	    <a href="<?=Url::toRoute(['site/login', 'service' => 'go'] + $arr);?>" class="soc_lnk eauth-service-link go"  data-eauth-service="google" data-event="<?=$location == 'profile' ? 'login' : 'test_way';?>" data-param="<?=$location == 'profile' ? 'login_go' : 'registration_go';?>">
	        <i class="zmdi zmdi-google-old"></i>
	    </a>
	<?=$wrapper == 'ul' ? '</li>' : '';?>
</<?=$wrapper;?>>