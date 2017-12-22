<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

use common\models\User;

class ParserController extends Controller {

	public function actionData($hashtag = 'fridaybothie') {
        $url = 'https://api.vk.com/method/newsfeed.search';
        $params = [
            "params[q]" => 'cat',
            'params[extended]' => 1,
            'params[count]' => 3,
            //'params[start_from]' => '6%2F-65395224_8404',
            'params[fields]' => 'profiles%20',
            'params[v]' => 5.69,
            'access_token' => 'af918e5daf918e5daf918e5d25aff1911caaf91af918e5df5a2130d3e85b32a77eea3d4',
        ];
        $params = [
            "q" => 'cat',
            'extended' => 1,
            'count' => 3,
            //'params[start_from]' => '6%2F-65395224_8404',
            'fields' => 'profiles%20',
            'v' => 5.69,
            'access_token' => 'af918e5daf918e5daf918e5d25aff1911caaf91af918e5df5a2130d3e85b32a77eea3d4',
        ];
        //$url = 'https://api.vk.com/method/newsfeed.search?params[q]=%23котик&params[extended]=1&params[count]=3&params[fields]=profiles%20&params[v]=5.69&access_token=af918e5daf918e5daf918e5d25aff1911caaf91af918e5df5a2130d3e85b32a77eea3d4';
//echo '\n';
        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);
//echo $url;exit;
        $res = file_get_contents($url);
        print_r($res);exit;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $res = curl_exec($curl);

        curl_close($curl);

        print_r($res);

        //newsfeed.search?params[q]=%23котик&params[extended]=1&params[count]=3&params[fields]=profiles%20&params[v]=5.69&access_token=af918e5daf918e5daf918e5d25aff1911caaf91af918e5df5a2130d3e85b32a77eea3d4
        //newsfeed.search?params[q]=%23котик&params[extended]=1&params[count]=3&params[fields]=profiles%20&params[v]=5.69
	}
}