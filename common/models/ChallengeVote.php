<?php

namespace common\models;

use Yii;

class ChallengeVote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%challenge_vote}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'challenge_id'], 'required'],
            [['user_id', 'challenge_id', 'created_at'], 'integer'],
            [['challenge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Challenge::className(), 'targetAttribute' => ['challenge_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => false
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
            'challenge_id' => 'Пост',
            'created_at' => 'Дата/Время',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        $this->challenge->likes = self::find()->where(['challenge_id'=>$this->challenge->id])->count();
        $this->challenge->save(false, ['likes']);

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::className(), ['id' => 'challenge_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function create($challenge_id) {
        $model = new self;
        $model->user_id = Yii::$app->user->id;
        $model->challenge_id = $challenge_id;

        $model->save();
    }
}
