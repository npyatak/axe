<?php

namespace common\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 5;
    /**
     * @var array EAuth attributes
     */
    public $profile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'status', 'created_at', 'updated_at', 'test_result_id', 'rules_test', 'rules_challenge', 'rules_clickbattle', 'rules_shooting', 'clickbattle_ban'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BANNED]],
            [['surname', 'name', 'image', 'city', 'ip', 'browser', 'email'], 'string', 'max' => 255],
            ['soc', 'string', 'max' => 2],
            [['test_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestResult::className(), 'targetAttribute' => ['test_result_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'soc' => 'Соц.сеть',
            'sid' => 'ID соц.сети',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'status' => 'Статус',
            'image' => 'Аватар',
            'city' => 'Город',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
            'ip' => 'IP адрес',
            'browser' => 'Браузер',
            'email' => 'Email',
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    // public function scenarios() {
    //     $scenarios = parent::scenarios();
    //     $scenarios['missing_fields'] = ['ig_username'];
    //     return $scenarios;
    // }

    public static function getStatusArray() {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BANNED => 'Забанен',
        ];
    }

    public function getStatusLabel() {
        return self::getStatusArray()[$this->status];
    }

    public function getId() {
        return $this->id;
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getAuthKey() {}
    
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByService($soc, $sid) {
        return static::find()->where(['soc' => $soc, 'sid' => $sid])->one();
    }

    public function getFullName() {
        return $this->name.' '.$this->surname;
    }
}
