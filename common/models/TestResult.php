<?php

namespace common\models;

use Yii;

class TestResult extends \yii\db\ActiveRecord
{
    public $answersArr = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_result';
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
            [['score', 'created_at', 'updated_at'], 'integer'],
            [['hash', 'answers'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hash' => 'Хэш',
            'score' => 'Результат',
            'answers' => 'Ответы'
        ];
    }

    public function beforeSave($insert) {
        $this->answers = json_encode($this->answersArr);

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        if(Question::find()->count() == count($this->answersArr) && !$this->result_id) {
            $questionAnswers = Answer::find()->indexBy('id')->all();
            $scores = [];
            foreach (json_decode($this->answers) as $answer) {
                if(!empty($questionAnswers[$answer->a_id]->scoreArr)) {
                    foreach ($questionAnswers[$answer->a_id]->scoreArr as $key => $value) {
                        if(isset($scores[$key])) {
                            $scores[$key] = $scores[$key] + $value;
                        } else {
                            $scores[$key] = $value;
                        }
                    }
                }
            }

            $this->result_id = array_keys($scores, max($scores))[0];
            $this->score = json_encode($scores);

            $this->save(false, ['result_id', 'score']);

            if(!Yii::$app->user->isGuest) {
                $user = User::findOne(Yii::$app->user->id);
                $user->test_result_id = $this->id;
                
                $user->save(false, ['test_result_id']);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind() {
        $this->answersArr = json_decode($this->answers);
    }

    public function getResult()
    {
        return $this->hasOne(Result::className(), ['id' => 'result_id']);
    }
}