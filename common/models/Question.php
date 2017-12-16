<?php

namespace common\models;

use Yii;

class Question extends \yii\db\ActiveRecord
{
    public $answersArray;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'number'], 'required'],
            [['title', 'comment'], 'string', 'max' => 255],
            ['number', 'integer'],
            ['answersArray', function($attribute, $params) {
                if(count($this->answersArray) < 2) {
                    $this->addError($attribute, 'Не менее двух вариантов');
                } else {
                    foreach ($this->answersArray as $item) {
                        $item->validate();
                        if($item->hasErrors()) {
                            $this->addError($attribute, 'Необходимо варианты ответов');
                        }
                    }
                }
            }],
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        $answerIds = [];
        $oldIds = Answer::find()->select('id')->where(['question_id' => $this->id])->column();
        foreach ($this->answersArray as $answer) {
            if($answer->id) {
                $answerIds[] = $answer->id;
            }
            $answer->question_id = $this->id;
            $answer->save();
        }

        foreach (array_diff($oldIds, $answerIds) as $idToDel) {
            Answer::findOne($idToDel)->delete();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function loadAnswers($newModels) {
        foreach ($newModels as $model) {
            if(isset($model['id']) && $model['id']) {
                $answer = Answer::findOne($model['id']);
            } else {
                $answer = new Answer;
            }
            $answer->load($model);
            $answer->attributes = $model;
            $this->answersArray[] = $answer;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'comment' => 'Комментарий',
            'number' => 'Порядковый номер'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }
}
