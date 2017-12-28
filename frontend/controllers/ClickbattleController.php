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
use common\models\ClickbattleResult;

class ClickbattleController extends Controller
{

    public function actionIndex() {
        $data = [];
        for ($i=1; $i <= 3 ; $i++) { 
            $x = rand(0, 950);
            $y = rand(0, 440);
            $data[$i] = ['x' => $x, 'y' => $y];
        }

        return $this->render('index', [
            'data' => $data,
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        ]);
    }

    public function actionRules() {
        return $this->render('rules', [
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        ]);
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
        $user = null;
        $userResult = null;
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            $userResult = ClickbattleResult::find()->where(['user_id' => $user->id])->orderBy('score')->one();
        }

        $results = ClickbattleResult::find()
            ->select(['user.*', 'clickbattle_result.*', 'max(clickbattle_result.score) as score'])
            ->joinWith('user')
            ->groupBy('user_id')
            ->orderBy('score')
            //->asArray()
            ->all();

        return $this->render('rating', [
            'user' =>  $user,
            'userResult' => $userResult,
            'results' => $results,
        ]);
    }

    public function actionCreate($user_id, $score) {
        $res = new ClickbattleResult;
        $res->score = $score;
        $res->user_id = $user_id;
        $res->save();
    }
}