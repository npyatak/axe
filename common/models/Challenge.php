<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

class Challenge extends \yii\db\ActiveRecord
{
    const SOC_VK = 1;
    const SOC_YOUTUBE = 2;

    const STATUS_NEW = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 9;

    public $link;
    public $video;
    public $_lastUserVotes;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%challenge}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['link', 'required', 'on' => 'userNew'],
            ['link', 'url'],
            ['link', 'checkLink'],
            [['user_id', 'soc', 'likes', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'platform', 'access_key', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['access_key', 'unique'],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['userNew'] = ['link'];
        return $scenarios;
    }

    public function checkLink($attribute, $model) {
        $key = $this->parseUrl();

        if(!$key) {
            $this->addError($attribute, 'Указана не верная ссылка');
        } elseif(self::find()->where(['access_key' => $key])->count() > 0) {
            $this->addError($attribute, 'Это видео уже было загружено');
        }
    }

    public function beforeSave($insert) {
        if($this->link) {
            $key = $this->parseUrl();
            $this->access_key = $key;
            if($this->soc == self::SOC_YOUTUBE) {
                $this->image = 'https://img.youtube.com/vi/'.$key.'/hqdefault.jpg';
            }
        }

        return parent::beforeSave($insert);
    }

    public function parseUrl() {
        $key = null;
        $urlParts = parse_url(trim($this->link));
        
        $this->soc = self::SOC_YOUTUBE;
        if(in_array($urlParts['host'], ['youtube.com', 'www.youtube.com'])) {
            parse_str($urlParts['query'], $queryParts);

            if(isset($queryParts['v'])) {
                $key = $queryParts['v'];
            } elseif (strripos($urlParts['path'], 'embed')) {
                $exp = explode('embed/', $urlParts['path']);
                if(isset($exp[1])) {
                    $key = $exp[1];
                }
            }
        } elseif(in_array($urlParts['host'], ['youtu.be', 'www.youtu.be'])) {
            $key = str_replace("/", "", $urlParts['path']);
        } elseif(in_array($urlParts['host'], ['vk.com', 'www.vk.com'])) {
            if(strripos($this->link, 'video')) {                
                //https://vk.com/video186707629_456239211
                //https://vk.com/video-37160097_456239728
                $exp = explode('video', $urlParts['path']);
                if(isset($exp[1])) {
                    $info = $this->vkVideoInfo($exp[1]);
                    if($info) {
                        if(isset($info->platform) && $info->platform == 'YouTube') {
                            $this->link = $info->player;
                            $this->parseUrl();
                        } else {
                            $urlParts = parse_url(trim($info->player));
                            parse_str($urlParts['query'], $queryParts);
                            $query = ['oid' => $queryParts['oid'], 'id' => $queryParts['id'], 'hash' => $queryParts['hash']];

                            $params = [];
                            foreach ($query as $key => $value) {
                                $params[] = $key.'='.$value; 
                            }
                            $key = implode('&', $params);

                            $sizes = ['photo_800', 'photo_640', 'photo_320', 'photo_160'];
                            foreach ($sizes as $size) {
                                if(isset($info->$size)) {
                                    $this->image = $info->$size;
                                    break;
                                }
                            }
                            $this->soc = self::SOC_VK;
                        }
                    }
                } 
            } elseif(strripos($this->link, 'wall')) {
                //https://vk.com/wall7921410_1837
                $exp = explode('wall', $urlParts['path']);
                if(isset($exp[1])) {
                    $info = $this->vkWallInfo($exp[1]);
                    if($info) {
                        $this->parseUrl();
                    }
                }
            }
        }

        return $key;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'name' => 'Имя',
            'soc' => 'Soc',
            'likes' => 'Лайки',
            'platform' => 'Platform',
            'access_key' => 'Id видео',
            'image' => 'Image',
            'created_at' => 'Время создания',
            'updated_at' => 'Updated At',
            'link' => 'Ссылка на youtube:',
            'video' => 'Видео',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatusArray() {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BANNED => 'Забанен',
        ];
    }

    public function getStatusLabel() {
        return self::getStatusArray()[$this->status];
    }

    public function getVideoLink() {
        switch ($this->soc) {
            case self::SOC_VK:
                return '//vk.com/video_ext.php?'.$this->access_key;
                break;
            case self::SOC_YOUTUBE:
                return '//www.youtube.com/embed/'.$this->access_key;
                break;
        }
    }

    public function userCanVote() {
        if($this->_lastUserVotes === null) {
            $this->_lastUserVotes = ChallengeVote::find()
                ->select(['challenge_id', 'max(created_at) as created_at'])
                ->where(['user_id'=>Yii::$app->user->id])
                ->orderBy('created_at DESC')
                ->asArray()
                ->indexBy('challenge_id')
                ->groupBy('challenge_id')
                ->all();
        }

        if(isset($this->_lastUserVotes[$this->id]) && $this->_lastUserVotes[$this->id]['created_at'] >= strtotime('today midnight')) {
            return false;
        } else {
            return true;
        }
    }

    public function vkVideoInfo($userId_videoId) {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        
        $user = Yii::$app->user->identity;
        $access_token = $user->access_token;
        if(!$access_token) {
            $someUser = User::find()->where(['not', ['access_token' => null]])->orderBy('updated_at DESC')->asArray()->one();
            if($someUser !== null) {
                $access_token = $someUser['access_token'];
            }
        }

        $url = 'https://api.vk.com/method/video.get';
        $params = [
            'videos' => $userId_videoId,
            //'extended' => 1,
            'v' => 5.69,
            'access_token' => $access_token,
        ];

        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);

        $res = file_get_contents($url);
        $res = json_decode($res);

        return (isset($res->response->items) && !empty($res->response->items)) ? $res->response->items[0] : null;
    }

    public function vkWallInfo($userId_postId) {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        
        $user = Yii::$app->user->identity;
        $access_token = $user->access_token;
        if(!$access_token) {
            $someUser = User::find()->where(['not', ['access_token' => null]])->orderBy('updated_at DESC')->asArray()->one();
            if($someUser !== null) {
                $access_token = $someUser['access_token'];
            }
        }

        $url = 'https://api.vk.com/method/wall.getById';
        $params = [
            'posts' => $userId_postId,
            //'extended' => 1,
            'v' => 5.69,
            'access_token' => $access_token,
        ];

        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);

        $res = file_get_contents($url);
        $res = json_decode($res);

        if(isset($res->response) && isset($res->response[0]) && isset($res->response[0]->attachments)) {
            foreach ($res->response[0]->attachments as $attachment) {
                if($attachment->type == 'video') {
                    $this->link = 'https://vk.com/video'.$attachment->video->owner_id.'_'.$attachment->video->id;
                    print_r($this->link);exit;
                    return true;
                }
            }
        }

        return false;
    }
}