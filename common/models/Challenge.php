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
        } elseif(in_array($urlParts['host'], ['vk.com', 'www.vk.com']) && strripos($this->link, 'video')) {
            $exp = explode('video', $urlParts['path']);
            if(isset($exp[1])) {
                $info = $this->vkVideoInfo($exp[1]);
                if($info) {
                    if(isset($info->platform) && $info->platform == 'YouTube') {
                        $this->link = $info->player;
                        $this->parseUrl();
                    } else {
                        $key = $info->player;

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
            //print_r($exp);exit;
            //https://vk.com/video186707629_456239211
            //https://vk.com/video-37160097_456239728
            //<iframe src="//vk.com/video_ext.php?oid=-37160097&id=456239728&hash=89fc8e0ab5b17394&hd=2" width="853" height="480" frameborder="0" allowfullscreen></iframe>
            //<iframe width="607" height="360" src="https://www.youtube.com/embed/GgJwglipbqA" frameborder="0" allowfullscreen></iframe>
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
                return $this->access_key;
                break;
            case self::SOC_YOUTUBE:
                return '//www.youtube.com/embed/'.$this->access_key;
                //return Url::to('https://www.youtube.com/watch?v='.$this->access_key);
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

        $url = 'https://api.vk.com/method/video.get';
        $params = [
            'videos' => $userId_videoId,
            //'extended' => 1,
            'v' => 5.69,
            'access_token' => $user->access_token,
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
}