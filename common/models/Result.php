<?php

namespace common\models;

use Yii;

class Result extends \yii\db\ActiveRecord
{
    public $shareVkImageFile;
    public $shareFbImageFile;
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
            [['title', 'text', 'share_title', 'share_text', 'share_vk_image', 'share_fb_image'], 'string', 'max' => 255],
            [['shareVkImageFile', 'shareFbImageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
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
            'share_title' => 'Заголовок поделиться',
            'shareVkImageFile' => 'Изображение поделиться VK',
            'shareFbImageFile' => 'Изображение поделиться FB',
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
        if(file_exists($path.$this->share_vk_image) && is_file($path.$this->share_vk_image)) {
            unlink($path.$this->share_vk_image);
        }
        if(file_exists($path.$this->share_fb_image) && is_file($path.$this->share_fb_image)) {
            unlink($path.$this->share_fb_image);
        }
        return parent::afterDelete();
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/images/';
    }

    public function getShareVkImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/images/'.$this->share_vk_image);
    }

    public function getShareFbImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/images/'.$this->share_fb_image);
    }
}
