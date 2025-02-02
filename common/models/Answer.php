<?php

namespace common\models;

use Yii;

class Answer extends \yii\db\ActiveRecord
{
    public $scoreArr;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'score'], 'required'],
            [['question_id'], 'integer'],
            [['title', 'score'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Вопрос',
            'title' => 'Заголовок',
            'score' => 'Баллы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    public function afterFind() {
        $this->scoreArr = json_decode($this->score);
    }
}
