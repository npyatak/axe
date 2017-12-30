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
use yii\data\ActiveDataProvider;

use common\models\User;
use common\models\ClickbattleResult;
use common\models\search\ClickbattleResultSearch;

class ClickbattleController extends Controller
{

    public function actionIndex() {
        $data = [];
        for ($i=1; $i <= 3 ; $i++) { 
            $x = rand(20, 930);
            $y = rand(20, 420);
            $data[$i] = ['x' => $x, 'y' => $y];
        }

        foreach ($results as $key => $result) {
            $key++;
            
        }

        return $this->render('index', [
            'data' => $data,
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
            'params' => Yii::$app->params['clickbattle'],
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
            $userResult = ClickbattleResult::find()->where(['user_id' => $user->id])->asArray()->sum('score');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => ClickbattleResult::find()
                ->select(['user.name', 'user.surname', 'user.city', 'clickbattle_result.*', 'sum(clickbattle_result.score) as totalScore'])
                ->joinWith('user')
                ->groupBy('user_id')
                ->orderBy('totalScore'),
            'totalCount' => ClickbattleResult::find()
                ->select(['clickbattle_result.*', 'sum(clickbattle_result.score) as totalScore'])
                ->groupBy('user_id')
                ->orderBy('totalScore')
                ->count(),
            'sort' => [
                'defaultOrder' => ['totalScore'=>SORT_DESC],
                'attributes' => ['created_at', 'totalScore'],
            ],
            'pagination' => [
                'pageSize' => 36,
            ],
        ]);

        return $this->render('rating', [
            'user' =>  $user,
            'userResult' => $userResult,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($user_id, $score) {
        $res = new ClickbattleResult;
        $res->score = $score;
        $res->user_id = $user_id;
        $res->save();
    }
}