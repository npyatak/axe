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

    public function actionIndex($name = null, $id = null) {
        //$challenges = Clickbattle::find()->where(['status' => Clickbattle::STATUS_ACTIVE])
        // $sort = Yii::$app->getRequest()->getQueryParam('sort');
   
        // $searchModel = new ClickbattleSearch();
        // $params = Yii::$app->request->queryParams;
        // $params['ClickbattleSearch']['status'] = Clickbattle::STATUS_ACTIVE;
        // $params['ClickbattleSearch']['name'] = $name;

        // $dataProvider = $searchModel->search($params);
        // $dataProvider->sort = [
        //     'defaultOrder' => ['likes'=>SORT_DESC],
        //     //'defaultOrder' => ['created_at'=>SORT_DESC],
        //     'attributes' => ['created_at', 'likes'],
        // ];

        // $activeClickbattle = false;
        // if($id) {
        //     $activeClickbattle = Clickbattle::findOne($id);
        // }

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        //     'sort' => $sort,
        //     'name' => $name,
        //     'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
        //     'activeClickbattle' => $activeClickbattle,
        // ]);
    }

    public function actionRules() {
        return $this->render('rules');
    }

    public function actionReg() {
        $challenges = [];

        $post = Yii::$app->request->post();
        if(!Yii::$app->user->isGuest && !empty($post)) {
            $user = Yii::$app->user->identity;
            foreach ($post['Clickbattle'] as $data) {
                $challenge = new Clickbattle;
                $challenge->scenario = 'userNew';
                $challenge->attributes = $data;
                $challenges[] = $challenge;
            }

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($challenges);
            }

            if(\yii\base\Model::validateMultiple($challenges)) {
                $flag = true;
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    foreach ($challenges as $challenge) {
                        if(!$flag) {
                            break;
                        } 
                        $challenge->name = $user->fullName;
                        $challenge->user_id = $user->id;
                        $challenge->soc = Clickbattle::SOC_YOUTUBE;

                        $flag = $challenge->save();
                    }

                    if ($flag) {
                        $transaction->commit();

                        $user->rules_challenge = 1;
                        $user->save(false, ['rules_challenge']);
                        
                        return $this->redirect(Url::toRoute(['challenge/ok']));
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('reg', [
            'challenges' => !empty($challenges) ? $challenges : [new Clickbattle],
        ]);
    }

    public function actionOk() {
        return $this->render('ok');
    }

    public function actionVote($id) {        
        if(!Yii::$app->user->isGuest && Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $challenge = Clickbattle::findOne($id);
            if($challenge !== null && $challenge->userCanVote()) {
                ClickbattleVote::create($id);

                $c = Clickbattle::find()->select('likes')->where(['id' => $id])->asArray()->one();
                return ['status' => 'success', 'likes' => $c['likes']];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function actionVkParse($hashtag = '#axegame') {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['profile/index']));
        }

        $user = Yii::$app->user->identity;

        $url = 'https://api.vk.com/method/video.search';
        $params = [
            'q' => $hashtag,
            'extended' => 1,
            //'count' => 3,
            //'params[start_from]' => '6%2F-65395224_8404',
            //'fields' => 'profiles',
            'v' => 5.69,
            'access_token' => $user->access_token,
            'redirect_uri' => 'https://oauth.vk.com/blank.html',
            'filters' => 'youtube',
            'sort' => 0,
        ];

        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);

        $res = file_get_contents($url);
        $res = json_decode($res);

        $names = [];
        foreach ($res->response->profiles as $profile) {
            $names[$profile->id] = $profile->first_name.' '.$profile->last_name;
        }
        foreach ($res->response->groups as $group) {
            $names[$group->id] = $group->name;
        }

        $addedCount = 0;
        foreach ($res->response->items as $item) {
            $challenge = new Clickbattle;

            $exp = explode('?', $item->player);
            $exp = explode('/', $exp[0]);
            $challenge->access_key = end($exp);

            $sizes = ['photo_800', 'photo_640', 'photo_320', 'photo_160'];
            foreach ($sizes as $size) {
                if(isset($item->$size)) {
                    $challenge->image = $item->$size;
                    break;
                }
            }
            
            if($item->owner_id && isset($names[$item->owner_id])) {
                $challenge->name = $names[$item->owner_id];
            }
            
            $challenge->soc = Clickbattle::SOC_VK;

            $challenge->save();
            if(Clickbattle::find()->where(['access_key' => $challenge->access_key])->one() === null) {
                $challenge->save();
                $addedCount++;
            } 
        }

        echo 'Найдено видео: '.count($res->response->items).' Добавлено новых: '.$addedCount;
    }
}