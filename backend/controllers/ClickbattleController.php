<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use common\models\ClickbattleResult;
use common\models\search\ClickbattleResultSearch;

/**
 * Controller implements the CRUD actions for Clickbattle model.
 */
class ClickbattleController extends CController
{
    /**
     * Lists all Clickbattle models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $results = ClickbattleResult::find()->asArray()
            ->joinWith('user')
            ->where(['user.clickbattle_ban' => null])
            ->andWhere(['not', ['clickbattle_result.targets' => null]])
            ->andWhere(['not', ['clickbattle_result.targets_server' => null]])
            ->all();

        //print_r(count($results));exit;

        foreach ($results as $r) {
            if($r['targets_server'] && $r['targets']) {
                $ts = json_decode($r['targets_server']);
                $t = json_decode($r['targets']);
                //print_r($ts);exit;
                for ($i=0; $i < 10; $i++) { 
                    // echo $ts[$i]->x.' - 15 != '.$t[$i]->x.' || '.$ts[$i]->y.' + 15 != '.$t[$i]->y;
                    // echo '<br>';
                    if(!isset($ts[$i]) || !isset($t[$i])) {
                        break;
                    }
                    if($ts[$i]->x - 15 != $t[$i]->x || $ts[$i]->y + 15 != $t[$i]->y) {
                        echo 'user_id = '.$r['user_id'].'. game_id = '.$r['id'];
                        echo '<br>';
                        break;
                    }
                }
            }
        }
    }

    protected function findModel($id)
    {
        if (($model = Clickbattle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
