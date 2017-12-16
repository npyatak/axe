<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii2-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace frontend\models\social;

class VkOAuth2Service extends \nodge\eauth\services\VKontakteOAuth2Service {

	protected function fetchAttributes() {
		$tokenData = $this->getAccessTokenData();
		$info = $this->makeSignedRequest('users.get.json', [
			'query' => [
				'uids' => $tokenData['params']['user_id'],
				//'fields' => '', // uid, first_name and last_name is always available
				'fields' => 'nickname, sex, bdate, city, country, timezone, photo, photo_medium, photo_big, photo_rec',
			],
		]);

		$info = $info['response'][0];

		$this->attributes = $info;
		$this->attributes['id'] = $info['uid'];
		$this->attributes['name'] = $info['first_name'] . ' ' . $info['last_name'];
		$this->attributes['url'] = 'http://vk.com/id' . $info['uid'];
		$this->attributes['photo_url'] = $info['photo_medium'];

		if (!empty($info['nickname'])) {
			$this->attributes['username'] = $info['nickname'];
		} else {
			$this->attributes['username'] = 'id' . $info['uid'];
		}

		$this->attributes['gender'] = $info['sex'] == 1 ? 'F' : 'M';

		if (!empty($info['timezone'])) {
			$this->attributes['timezone'] = timezone_name_from_abbr('', $info['timezone'] * 3600, date('I'));
		}

		$this->attributes['country'] = json_decode(file_get_contents('https://api.vk.com/method/database.getCountriesById' . '?' . urldecode(http_build_query(['country_ids' => $info['country']]))), true);
		$this->attributes['country'] = $this->country['response'][0]['name'];
		
		$this->attributes['city'] = json_decode(file_get_contents('https://api.vk.com/method/database.getCitiesById' . '?' . urldecode(http_build_query(['city_ids' => $info['city']]))), true);
		$this->attributes['city'] = $this->city['response'][0]['name'];

		$smas=explode('.',$info['bdate']);
		$str = $smas[2]. '-' . $smas[1] . '-'. $smas[0];
		$timestamp = strtotime($str);
		$this->attributes['bdate'] = date('Y-n-d ', $timestamp);

		return true;
	}
}
