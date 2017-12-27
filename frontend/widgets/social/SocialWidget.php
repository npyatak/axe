<?php
namespace frontend\widgets\social;
//use common\models\User;

class SocialWidget extends \nodge\eauth\Widget {
	public $location;
	public $rules;
	//public $assetBundle = 'frontend\assets\EauthAsset';

    public function run() {
		echo $this->render('widget', [
			'id' => $this->getId(),
			'services' => $this->services,
			'action' => $this->action,
			'popup' => $this->popup,
			'assetBundle' => $this->assetBundle,
			'location' => $this->location,
			'rules' => $this->rules,
		]);
    }
}