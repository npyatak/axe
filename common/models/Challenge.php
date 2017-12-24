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
            [['user_id', 'soc', 'likes', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'platform', 'access_key', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['userNew'] = ['link'];
        return $scenarios;
    }

    public function checkLink($attribute, $model) {
        $exp = explode('v=', $this->link);
        if(!isset($exp[1])) {
            $this->addError($attribute, 'Указана не верная ссылка');
        }
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
                # code...
                break;
            case self::SOC_YOUTUBE:
                return Url::to('https://www.youtube.com/watch?v='.$this->access_key);
                break;
        }
    }
}
