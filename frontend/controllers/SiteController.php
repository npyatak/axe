<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;
use frontend\widgets\cropimage\helpers\Image;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\web\Response;

use common\models\User;
use common\models\Question;
use common\models\TestResult;
use common\models\Result;
use common\models\Page;
use common\models\Challenge;
use common\models\search\ChallengeSearch;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'eauth' => [
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login'],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'test'],
                'rules' => [
                    [
                        'actions' => ['login', 'test'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex($cybertest = null)
    {
        $news = null;
        $result = null;

        if($cybertest) {
            $result = Result::findOne($cybertest);
        }
        
        return $this->render('index', [
            'news' => $news,
            'result' => $result,
        ]);
    }

    public function actionTest() {
        $qestionsCount = Question::find()->count();
        $testResultId = Yii::$app->request->cookies->getValue('test_hash', null);

        $flag = false;
        if($testResultId !== null) {
            $testResult = TestResult::findOne($testResultId);
        } else {
            $flag = true;
        }
        if(!isset($testResult) || $testResult === null) {
            $flag = true;
        } elseif($qestionsCount == count($testResult->answersArr)) {
            if(Yii::$app->user->isGuest) {
                $flag = true;
            } else {
                return $this->redirect(Url::toRoute(['profile/index']));
            }
        }

        if($flag) {
            $testResult = new TestResult;
            $testResult->save();

            $cookies = Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'test_hash',
                'value' => $testResult->id,
            ]));
        }

        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && !empty($post) && $post['question'] && $post['answer']) { 
            $testResult->answersArr[] = ['q_id' => $post['question'], 'a_id' => $post['answer']];
            $testResult->save();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($qestionsCount == count($testResult->answersArr)) {
                return ['status' => 'redirect'];
            }

            return ['status' => 'success'];
        }

        $questions = Question::find()->joinWith('answers')->orderBy('number')->all();

        $initialSlide = 0;
        if(!empty($testResult->answersArr)) {
            $initialSlide = count($testResult->answersArr);
        }

        return $this->render('test', [
            'questions' => $questions,
            'initialSlide' => $initialSlide,
        ]);
    }

    public function actionRestartTest() {
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            if($user->test_result_id) {
                $testResult = TestResult::findOne($user->test_result_id);
                if($testResult !== null) {
                    $testResult->delete();
                }
                $user->test_result_id = null;
                $user->save(false, ['test_result_id']);
            }
        }

        Yii::$app->response->cookies->remove('test_hash');

        return $this->redirect(Url::toRoute(['site/test']));
    }

    public function actionTestResult() {
        $testResultId = Yii::$app->request->cookies->getValue('test_hash', null);

        if(!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            if($user->test_result_id) {
                $testResultId = $user->test_result_id;
            }
        }
        if($testResultId) {
            $testResult = TestResult::findOne($testResultId);

            if($testResult !== null && $testResult->result_id) {
                $result = Result::findOne($testResult->result_id);

                return $this->render('test_result', [
                    'result' => $result,
                ]);
            }
        }

        return $this->redirect(['site/test']);
    }

    public function actionChallengeRules() {
        return $this->render('challenge-rules');
    }

    public function actionChallengeReg() {
        $challenges = [];

        $post = Yii::$app->request->post();
        if(!Yii::$app->user->isGuest && !empty($post)) {
            $user = Yii::$app->user->identity;
            foreach ($post['Challenge'] as $data) {
                $challenge = new Challenge;
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
                        $exp = explode('v=', $challenge->link);
                        $challenge->access_key = $exp[1];
                        $challenge->name = $user->fullName;
                        $challenge->user_id = $user->id;
                        $challenge->soc = Challenge::SOC_YOUTUBE;

                        $flag = $challenge->save(false);
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(Url::toRoute(['site/challenge-ok']));
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('challenge-reg', [
            'challenges' => !empty($challenges) ? $challenges : [new Challenge],
        ]);
    }

    public function actionChallengeOk() {
        return $this->render('challenge-ok');
    }

    public function actionChallenge($name = null) {
        //$challenges = Challenge::find()->where(['status' => Challenge::STATUS_ACTIVE])
        
        $searchModel = new ChallengeSearch();
        $params = Yii::$app->request->queryParams;
        $params['ChallengeSearch']['status'] = Challenge::STATUS_ACTIVE;
        $dataProvider = $searchModel->search($params);

        //print_r($dataProvider->models);exit;

        return $this->render('challenge', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogin() {
        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        $ref = Yii::$app->getRequest()->getQueryParam('ref');
        $rules = Yii::$app->getRequest()->getQueryParam('rules');

        if (isset($serviceName)) {
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);

            $eauth->setRedirectUrl(Url::toRoute('site/test-result'));
            if($ref !== '') {
                $eauth->setRedirectUrl(Url::to($ref));
            }
            $eauth->setCancelUrl(Url::toRoute('profile/index'));

            try {
                if ($eauth->authenticate()) {
                    $user = User::findByService($serviceName, $eauth->id);
                    if($user === null) {
                        $user = new User;
                        $user->soc = $serviceName;
                        $user->sid = $eauth->id;
                        $user->name = $eauth->first_name;
                        $user->surname = $eauth->last_name;
                        if(isset($eauth->photo_url)) $user->image = $eauth->photo_url;
                        if(isset($eauth->city)) $user->city = $eauth->city;

                        $test_result_id = Yii::$app->request->cookies->getValue('test_hash', null);
                        if($test_result_id != null) {
                            if(TestResult::findOne($test_result_id) != null) {
                                $user->test_result_id = $test_result_id;
                            }
                        }
                        
                        $user->save();
                    } elseif($user->status === User::STATUS_BANNED) {
                        Yii::$app->getSession()->setFlash('error', 'Вы не можете войти. Ваш аккаунт заблокирован');
                        
                        $eauth->redirect($eauth->getCancelUrl());
                    } 
                    if($rules != '') {
                        $attr = 'rules_'.$rules;
                        if($user->hasAttribute($attr)) {
                            $user->$attr = 1;
                            $user->save(false, [$attr]);
                        }
                    }

                    if(isset($eauth->access_token)) $user->access_token = $eauth->access_token;
                    if(isset($eauth->email)) $user->email = $eauth->email;
                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    $user->browser = $_SERVER['HTTP_USER_AGENT'];
                    $user->save(false);

                    Yii::$app->user->login($user, 3600 * 24 * 365);
                    // special redirect with closing popup window
                    $eauth->redirect();
                } else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                    $eauth->redirect($eauth->getCancelUrl());
                }
            } catch (\nodge\eauth\ErrorException $e) {
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        return $this->render('login');
    }

    public function actionVideo() {

        return $this->render('video', [
            'otherVideos' => null,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

    public function actionPage($url) {
        $model = Page::findByUrl($url);
        if($model === null || $model->status === Page::STATUS_INACTIVE) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if($model->title) $this->view->title = $model->title;
        if($model->description) $this->view->registerMetaTag(['description' => $model->description], 'description');
        if($model->keywords) $this->view->registerMetaTag(['keywords' => $model->keywords], 'keywords');

        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionNews() {
        return $this->render('news', [

        ]);
    }

    public function actionRules() {
        return $this->render('rules');
    }

    public function actionLogin2($id = 1) {
        $user = User::findOne($id);

        Yii::$app->getUser()->login($user);

        return $this->redirect('/');
    }

    public function actionVkParse($hashtag = 'house') {
        if(Yii::$app->user->isGuest) {
            return $this->redirect('profile/index');
        }

        $user = Yii::$app->user->identity;

        $url = 'https://api.vk.com/method/video.search';
        $params = [
            'q' => $hashtag,
            'extended' => 1,
            //'count' => 3,
            //'params[start_from]' => '6%2F-65395224_8404',
            'fields' => 'profiles%20',
            'v' => 5.69,
            'access_token' => $user->access_token,
            'redirect_uri' => 'https://oauth.vk.com/blank.html',
        ];

        $postParams = [];
        foreach ($params as $key => $value) {
            $postParams[] = $key.'='.$value; 
        }
        $url = $url.'?'.implode('&', $postParams);

        $res = file_get_contents($url);
        $res = json_decode($res);

        foreach ($res->response->items as $item) {
            # code...
        }
    }
}