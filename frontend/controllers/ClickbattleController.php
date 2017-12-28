<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\web\Response;

use common\models\User;

class ClickbattleController extends Controller
{

    public function actionIndex() {

        return $this->render('index', [
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        ]);
    }

    public function actionRules() {
        return $this->render('rules');
    }

    public function actionReg() {

        return $this->render('reg', [
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        ]);
    }

    public function actionOk() {
        return $this->render('ok');
    }

    public function actionRating() {

        return $this->render('rating', [
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        ]);
    }
}