<?php
namespace frontend\models\social;

class GoOAuth2Service extends \nodge\eauth\services\GoogleOAuth2Service
{

    /**
     *
     * @see GoogleOAuth2Service::fetchAttributes()
     */
    protected function fetchAttributes()
    {
        $info = $this->makeSignedRequest('https://www.googleapis.com/oauth2/v1/userinfo');

        $this->attributes['id'] = $info['id'];
        $this->attributes['name'] = $info['name'];
        $this->attributes['email'] = $info['email'];
        $this->attributes['first_name'] = $info['given_name']; // first name
        $this->attributes['last_name'] = $info['family_name']; // last name

        if (!empty($info['link'])) {
            $this->attributes['url'] = $info['link'];
        }
        $this->attributes['photo_url'] = $info['picture'];
        $this->attributes['sex'] = $info['gender'] == 'male' ? 2 : 1;

        /*if (!empty($info['gender']))
            $this->attributes['gender'] = $info['gender'] == 'male' ? 'M' : 'F';
        
        if (!empty($info['picture']))
            $this->attributes['photo'] = $info['picture'];
        
        $info['given_name']; // first name
        $info['family_name']; // last name
        $info['birthday']; // format: 0000-00-00
        $info['locale']; // format: en*/
    }
}
