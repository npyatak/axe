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
        if(Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['clickbattle/reg']));
        }
        $model = new ClickbattleResult;
        $gamesCount = ClickbattleResult::getUserGamesCount();

        $user = User::findOne(Yii::$app->user->id);
        $user->rules_clickbattle = 1;
        $user->save(false, ['rules_clickbattle']);

        $params = Yii::$app->params['clickbattle'];
        $data = [];
        for ($i=0; $i <= ($params['endGameTime'] / (2 * $params['delayInterval']) + 10); $i++) { 
            $x = rand(20, 930);
            $y = rand(20, 420);
            $data[$i] = ['x' => $x, 'y' => $y];
        }

        $post = Yii::$app->request->post();
        if(!Yii::$app->user->isGuest && $model->load($post)) {
            if(isset($post['ClickbattleResult']['reCaptcha'])) {
                $model->re_captcha = $post['ClickbattleResult']['reCaptcha'];
            }
            if(isset($post['g-recaptcha-response'])) {
                $model->re_captcha_response = 'ok';
            }

            $targets = json_decode($model->targets);
            $clicks = json_decode($model->clicks);

            $targetArr = [];
            foreach ($targets as $key => $t) {
                if(isset($t->time)) {
                    $targetArr[$t->time] = ['x' => $t->x, 'y' => $t->y];
                }
            }

            $score = 0;
            foreach ($clicks as $time => $coords) {
                $flag = true;
                $targetTime = $coords->t;

                if($time >= $targetTime && $time <= $targetTime + $params['targetLifeDurationInterval']) {
                    if(isset($targetArr[$targetTime])) {
                        $x = floatval($targetArr[$targetTime]['x']) + 15;
                        $y = floatval($targetArr[$targetTime]['y']) - 15;
                        /*(x-x1)^2 + (y-y1)^2 <= R^2, где R - радиус окружности, который заносим в константы, по умолчанию радиус равен 20.
                        То значит попал, количество баллов в плюс равно:
                        округление до целых от квадратного корня из (x-x1)^2 + (y-y1)^2,
                        то есть грубо у нас от 0 до 20 баллов за попадание с дискретностью в единицу.*/
                        $distance = round(sqrt(pow(($x - (int)$coords->x), 2) + pow(($y - (int)$coords->y), 2)));

                        if($distance <= $params['radius']) {
                            $flag = false;
                            $score += $params['radius'] - $distance;
                        }
                    }
                }
                if($flag) {
                    $score -= 2;
                }
            }

            if($score < 0) {
                $score = 0;
            } elseif($score > 1500) {
                $score = 1500;
            }

            $model->score = $score;
            $model->user_id = Yii::$app->user->id;
            $model->targets = $model->targets;
            $model->clicks = $model->clicks;
            if($model->save()) {
                return $this->redirect(['result']);
            } else {
                if(isset($post['g-recaptcha-response'])) {
                    $model->re_captcha_response = 'ne ok';
                }
                $model->save(false);
                return $this->redirect(['result']);
            }
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => 'success', 'score' => $score];
        }

        return $this->render('index', [
            'data' => $data,
            'user' => $user,
            'params' => $params,
            'model' => $model,
            'gamesCount' => $gamesCount,
        ]);
    }

    public function actionResult() {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['clickbattle/reg']));
        }

        $result = ClickbattleResult::find()->where(['user_id' => Yii::$app->user->id])->orderBy('id DESC')->one();

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
            if(!$user->clickbattle_ban) {
                $userResult = ClickbattleResult::find()->where(['user_id' => $user->id])->asArray()->sum('score');
            }
            
            $results = ClickbattleResult::find()->asArray()
                ->joinWith('user')
                ->where(['user.clickbattle_ban' => null])
                ->select(['sum(score) as score', 'user_id'])
                ->groupBy('user_id')->orderBy('score DESC')
                ->indexBy('user_id')
                ->all();
            $userPlace = array_search($user->id, array_keys($results)) + 1;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => ClickbattleResult::find()
                ->select(['user.name', 'user.surname', 'user.city', 'clickbattle_result.*', 'sum(clickbattle_result.score) as totalScore'])
                ->joinWith('user')
                ->where(['user.clickbattle_ban' => null])
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
                'pageSize' => 72,
            ],
        ]);

        return $this->render('rating', [
            'user' =>  $user,
            'userResult' => $userResult,
            'dataProvider' => $dataProvider,
            'userPlace' => $userPlace,
        ]);
    }

    public function actionCreate($user_id, $score) {
        $res = new ClickbattleResult;
        $res->score = $score;
        $res->user_id = $user_id;
        $res->save();
    }
}