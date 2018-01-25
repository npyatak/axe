<?php

namespace common\models;

use Yii;

class ClickbattleResult extends \yii\db\ActiveRecord
{
    public $totalScore;
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clickbattle_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'client_score', 'score', 'targets_type'], 'integer'],
            [['ip'], 'string', 'max' => 255],
            [['targets', 'targets_server', 'clicks', 're_captcha', 're_captcha_response'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['reCaptcha'], \frontend\components\ReCaptchaValidator::className(), 'uncheckedMessage' => 'Пожалуйста, подтвердите, что вы не робот', 'skipOnEmpty' => function($model) {
                $count = Yii::$app->params['clickbattle']['gamesWithoutCaptcha'];
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

    // public function afterSave($insert, $changedAttributes) {
    //     $this->challenge->likes = self::find()->where(['challenge_id'=>$this->challenge->id])->count();
    //     $this->challenge->save(false, ['likes']);

    //     return parent::afterSave($insert, $changedAttributes);
    // }

    public function beforeSave($insert) {
        $this->ip = $_SERVER['REMOTE_ADDR'];

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
