<?php

namespace common\models;

use Yii;

class ClickbattleResult extends \yii\db\ActiveRecord
{
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
            [['user_id', 'created_at', 'client_score', 'score'], 'integer'],
            [['ip'], 'string', 'max' => 255],
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
