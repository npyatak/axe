<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $category_id
 * @property string $title
 * @property string $subtitle
 * @property string $preview
 * @property string $text
 * @property string $keywords
 * @property string $description
 * @property integer $status
 * @property integer $is_page
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 */
class Page extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;

    const IS_PAGE_YES = 1;
    const IS_PAGE_NO = 0;

    public $imageFile;
    public $shareImageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'category_id'], 'required'],
            [['category_id', 'status', 'is_page', 'created_at', 'updated_at'], 'integer'],
            [['text', 'keywords', 'description', 'share_text', 'share_title', 'share_image', 'menu_title'], 'string'],
            [['alias', 'title', 'subtitle'], 'string', 'max' => 255],
            [['preview'], 'string', 'max' => 1000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['imageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Алиас',
            'category_id' => 'Категория',
            'title' => 'Заголовок',
            'subtitle' => 'Подзаголовок',
            'preview' => 'Вводный текст',
            'text' => 'Текст',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'status' => 'Статус',
            'is_page' => 'Отдельная страница',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'imageFile' => 'Изображение',
            'share_text' => 'Текст поделиться',
            'share_title' => 'Заголовок поделиться',
            'share_image' => 'Изображение поделиться',
            'menu_title' => 'Заголовок для меню',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function findByUrl($alias) {
        return self::findOne(['alias'=>$alias]);
    }

    public function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивна',
            self::STATUS_ACTIVE => 'Активна',
        ];
    }

    public function getIsPageArray() {
        return [
            self::IS_PAGE_YES => 'Да',
            self::IS_PAGE_NO => 'Нет',
        ];
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/page/';
    }

    public function getImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/page/'.$this->image);
    }

    public function getShareImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/page/'.$this->share_image);
    }

    public function getUrl() {
        return Url::toRoute(['site/page', 'alias' => $this->alias]);
    }

    public function getPreviewUrl() {
        return Url::toRoute(['site/preview', 'alias' => $this->alias]);
    }

    public function getMenuTitle() {
        return $this->menu_title ? $this->menu_title : $this->title;
    }
}
