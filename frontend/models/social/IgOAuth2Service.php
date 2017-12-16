<?php

namespace frontend\models\social;

use nodge\eauth\oauth2\Service;
use OAuth\Common\Token\TokenInterface;
use OAuth\OAuth2\Service\ServiceInterface;

class IgOAuth2Service extends \nodge\eauth\services\InstagramOAuth2Service
{
	protected function fetchAttributes()
	{
		$info = $this->makeSignedRequest('users/self');
		$data = $info['data'];

		if($data['full_name']) {
			$exp = explode(' ', $data['full_name']);
			$name = $exp[0];
			if(isset($exp[1])) {
				$surname = $exp[1];
			}
		}

		$this->attributes['id'] = $data['id'];
		$this->attributes['first_name'] = isset($name) ? $name : '';
		$this->attributes['last_name'] = isset($surname) ? $surname : '';
		$this->attributes['photo_url'] = $data['profile_picture'];
		$this->attributes['ig_id'] = $data['id'];
		$this->attributes['ig_username'] = $data['username'];

		return true;
	}
}