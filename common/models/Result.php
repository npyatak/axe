<?php

namespace common\models;

use Yii;

class Result extends \yii\db\ActiveRecord
{
    public $shareImageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['title', 'text', 'share_text', 'share_image'], 'string', 'max' => 255],
            [['shareImageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'share_text' => 'Текст поделиться',
            'shareImageFile' => 'Изображение поделиться',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::className(), ['result_id' => 'id']);
    }

    public function afterDelete() {
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->share_image) && is_file($path.$this->share_image)) {
            unlink($path.$this->share_image);
        }
        return parent::afterDelete();
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/images/';
    }

    public function getShareImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/images/'.$this->share_image);
    }
}
