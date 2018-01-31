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
use common\models\ShootingResult;
use common\models\search\ShootingResultSearch;

class ShootingController extends Controller
{

    public function actionIndex() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['shooting/reg']));
        }
        $gamesCount = ShootingResult::getUserGamesCount();

        $user = User::findOne(Yii::$app->user->id);
        $user->rules_shooting = 1;
        $user->save(false, ['rules_shooting']);

        $params = Yii::$app->params['shooting'];

        $post = Yii::$app->request->post();
        if(isset($post['ShootingResult'])) {
            $model = ShootingResult::find()->where(['user_id' => Yii::$app->user->id])->orderBy('id DESC')->one();
            $model->load($post);
            if(isset($post['ShootingResult']['reCaptcha'])) {
                $model->re_captcha = $post['ShootingResult']['reCaptcha'];
            }
            if($gamesCount > $params['gamesWithoutCaptcha']) {
                $model->re_captcha_response = 'ok';
            }

            $model->score = $model->client_score;
            if($model->client_score > 1000) {
                $model->score = 1000;
            } elseif ($model->client_score < 0) {
                $model->score = 0;
            }

            $model->validate();
            
            if($gamesCount > $params['gamesWithoutCaptcha']) {
                $model->re_captcha_response = json_encode($_POST['GoogleResponse']);
            }

            if($model->save(false)) {
                return $this->redirect(['result']);
            }
        } else {
            $model = new ShootingResult;
            $model->user_id = Yii::$app->user->id;
            $model->score = 0;
            $model->save();
        }

        return $this->render('index', [
            'user' => $user,
            'params' => $params,
            'model' => $model,
            'gamesCount' => $gamesCount,
        ]);
    }

    public function actionResult() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['shooting/reg']));
        }

        $result = ShootingResult::find()->where(['user_id' => Yii::$app->user->id])->orderBy('id DESC')->one();

        if($result === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('result', [
            'result' => $result,
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

    public function actionRating() {
        $user = null;
        $userResult = null;
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            if(!$user->shooting_ban) {
                $userResult = ShootingResult::find()->where(['user_id' => $user->id])->asArray()->sum('score');       
            }
            
            $results = ShootingResult::find()->asArray()
                ->joinWith('user')
                ->where(['user.shooting_ban' => null])
                ->select(['sum(score) as score', 'user_id'])
                ->groupBy('user_id')->orderBy('score DESC')
                ->indexBy('user_id')
                ->all();
            $userPlace = array_search($user->id, array_keys($results)) + 1;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => ShootingResult::find()
                ->select(['user.name', 'user.surname', 'user.city', 'shooting_result.*', 'sum(shooting_result.score) as totalScore'])
                ->joinWith('user')
                ->where(['user.shooting_ban' => null])
                ->groupBy('user_id')
                ->orderBy('totalScore'),
            'totalCount' => ShootingResult::find()
                ->select(['shooting_result.*', 'sum(shooting_result.score) as totalScore'])
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
            'userPlace' => $userPlace,
        ]);
    }

    public function actionPlayAgain() {
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
            $lastGame = ShootingResult::find()->where(['user_id' => Yii::$app->user->id])->orderBy('id DESC')->one();

            if($lastGame === null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            $lastGame->play_again = 1;
            $lastGame->save(false, ['play_again']);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => 'success'];
        }
    }
}