<?php

namespace common\models;

use Yii;

class ShootingResult extends \yii\db\ActiveRecord
{
    public $totalScore;
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shooting_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'client_score', 'score', 'play_again'], 'integer'],
            [['ip', 'browser'], 'string'],
            [['re_captcha', 're_captcha_response'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['reCaptcha'], \frontend\components\ReCaptchaValidator::className(), 'uncheckedMessage' => 'Пожалуйста, подтвердите, что вы не робот', 'skipOnEmpty' => function($model) {
                $count = Yii::$app->params['shooting']['gamesWithoutCaptcha'];
                return self::getUserGamesCount() < $count;
            }],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'score' => 'Баллы',
            'client_score' => 'Баллы на клиенте',
            'created_at' => 'Дата/Время',
        ];
    }

    public function beforeSave($insert) {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->browser = $_SERVER['HTTP_USER_AGENT'];

        return parent::beforeSave($insert);
    }
                    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getScoreText($score = null) {
        $score = $score ? $score : $this->score;
        $arr = str_split($score);
        $lastDigit = end($arr);
        if($lastDigit == 1) {
            return 'балл';
        } elseif(in_array($lastDigit, [2, 3, 4])) {
            return 'балла';
        } else {
            return 'баллов';
        }
    }

    public function getUserGamesCount() {
        return self::find()->where(['user_id' => Yii::$app->user->id])->count();
    }
}
