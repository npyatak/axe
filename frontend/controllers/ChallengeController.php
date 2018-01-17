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
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;

use common\models\User;
use common\models\Challenge;
use common\models\ChallengeVote;
use common\models\search\ChallengeSearch;

class ChallengeController extends Controller
{

    public function actionIndex($name = null, $id = null) {
        $pageSize = 30;
        $sort = Yii::$app->getRequest()->getQueryParam('sort');
   
        $searchModel = new ChallengeSearch();
        $params = Yii::$app->request->queryParams;
        $params['ChallengeSearch']['status'] = Challenge::STATUS_ACTIVE;
        $params['ChallengeSearch']['name'] = $name;

        $dataProviderAll = $searchModel->search($params);
        // $dataProviderAll->sort = [
        //     'defaultOrder' => ['likes'=>SORT_DESC],
        //     'attributes' => ['created_at', 'likes'],
        // ];
        $dataProviderAll->pagination = [
            //'pageSize' => $pageSize,
        ];
        
        $activeChallenge = false;
        if($id) {
            $activeChallenge = Challenge::findOne($id);

            if($activeChallenge !== null) {
                $dataProviderAll->pagination = [
                    //'pageSize' => $pageSize - 1,
                ];
            }

            $params['ChallengeSearch']['name'] = null;
            $params['ChallengeSearch']['id'] = $id;
            $dataProviderActive = $searchModel->search($params);

            $data = array_merge($dataProviderActive->getModels(), $dataProviderAll->getModels());
        } else {
            $data = $dataProviderAll->getModels();
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                //'defaultOrder' => ['likes'=>SORT_DESC],
                'attributes' => ['created_at', 'likes'],
            ] 
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'name' => $name,
            'user' => Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id),
            'activeChallenge' => $activeChallenge,
        ]);
    }

    public function actionRules() {
        return $this->render('rules');
    }

    public function actionReg() {
        $challenges = [];

        $post = Yii::$app->request->post();
        if(!Yii::$app->user->isGuest && !empty($post)) {
            $user = Yii::$app->user->identity;
            foreach ($post['Challenge'] as $data) {
                $challenge = new Challenge;
                $challenge->scenario = 'userNew';
                $challenge->attributes = $data;
                if(isset($data['videoFile'])) {
                    $challenge->videoFile = UploadedFile::getInstanceByName('Challenge[0][videoFile]');
                    if($challenge->videoFile) {
                        unset($challenge['link']);
                        $challenge->scenario = 'videoUpload';
                    }
                }
                $challenges[] = $challenge;
                if($challenge->scenario == 'videoUpload') {
                    break;
                }
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
            'challenges' => !empty($challenges) ? $challenges : [new Challenge],
        ]);
    }

    public function actionOk() {
        return $this->render('ok');
    }

    public function actionVote($id) {        
        if(!Yii::$app->user->isGuest && Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $challenge = Challenge::findOne($id);
            if($challenge !== null && $challenge->userCanVote()) {
                ChallengeVote::create($id);

                $c = Challenge::find()->select('likes')->where(['id' => $id])->asArray()->one();
                return ['status' => 'success', 'likes' => $c['likes']];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function actionVkParse($hashtag = 'axebest') {
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
            'fields' => 'profiles',
            'v' => 5.69,
            'access_token' => $user->access_token,
            'redirect_uri' => 'https://oauth.vk.com/blank.html',
            // 'filters' => 'youtube',
            // 'sort' => 0,
        ];

        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);

        $res = file_get_contents($url);
        $res = json_decode($res);

        if(isset($res->response)) {
            $names = [];
            $addedCount = 0;
            if($res->response->profiles) {
                foreach ($res->response->profiles as $profile) {
                    $names[$profile->id] = $profile->first_name.' '.$profile->last_name;
                }
            }
            if($res->response->groups) {
                foreach ($res->response->groups as $group) {
                    $names[$group->id] = $group->name;
                }
            }

            if($res->response->items) {
                foreach ($res->response->items as $item) {
                    $challenge = new Challenge;

                    if(isset($item->platform) && $item->platform == 'YouTube') {
                        $challenge->link = $item->player;
                    } else {
                        $challenge->link = 'https://vk.com/video'.$item->owner_id.'_'.$item->id;
                    }
                    // $exp = explode('?', $item->player);
                    // $exp = explode('/', $exp[0]);
                    // $challenge->access_key = end($exp);

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
                    
                    //$challenge->soc = Challenge::SOC_YOUTUBE;

                    if($challenge->save()) {
                        $addedCount++;
                    }
                    
                    // if(Challenge::find()->where(['access_key' => $challenge->access_key])->one() === null) {
                    //     $challenge->save();
                    //     $addedCount++;
                    // } 
                }
            }

            echo 'Найдено видео: '.count($res->response->items).' Добавлено новых: '.$addedCount;
        } else {
            echo 'Что-то пошло не так. Ответ сервера: ';
            print_r($res);
        }
    }
}
