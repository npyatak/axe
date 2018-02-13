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
            ->select(['user.id', 'user.surname','user.clickbattle_ban', 'clickbattle_result.id', 'clickbattle_result.user_id', 'clickbattle_result.targets_server', 'clickbattle_result.targets'])
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
                        echo 'user: id = '.$r['user_id'].' surname = '.$r['user']['surname'].'. game_id = '.$r['id'];
                        echo '<br>';
                        break;
                    }
                }
            }
            $t = null;
            $ts = null;
        }
    }
}
