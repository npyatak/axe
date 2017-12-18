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
use common\models\Result;
use common\models\TestResult;
use common\models\Page;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
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

    public function actionIndex() {
        $user = null;
        $result = null;
        if(!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            if($user->test_result_id) {
                $testResult = TestResult::findOne($user->test_result_id);
                if($testResult !== null && $testResult->result_id) {
                    $result = Result::findOne($testResult->result_id);
                }
            }
        }

        return $this->render('index', [
            'user' => $user,
            'result' => $result,
        ]);
    }
}