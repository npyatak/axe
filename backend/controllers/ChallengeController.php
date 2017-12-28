<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use common\models\Challenge;
use common\models\search\ChallengeSearch;

/**
 * Controller implements the CRUD actions for Challenge model.
 */
class ChallengeController extends CController
{
    /**
     * Lists all Challenge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChallengeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort = [
            'defaultOrder' => ['status' => SORT_ASC, 'id' => SORT_DESC],
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatus($id, $status) {
        $model = $this->findModel($id);
        $model->status = $status;

        return $model->save(false);
        
        //return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Challenge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Challenge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Challenge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Challenge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
