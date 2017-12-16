<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use common\models\Result;
use common\models\search\ResultSearch;

/**
 * Controller implements the CRUD actions for Result model.
 */
class ResultController extends CController
{
    /**
     * Lists all Result models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->shareImageFile = UploadedFile::getInstance($model, 'shareImageFile');

            if($model->shareImageFile) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }

                $model->share_image = md5(time()).'.'.$model->shareImageFile->extension;
                
                if($model->save()) {
                    if(isset($oldImage)) {
                        unlink($oldImage);
                    }
                    $model->shareImageFile->saveAs($path.$model->share_image);
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->shareImageFile = UploadedFile::getInstance($model, 'shareImageFile');

            if($model->shareImageFile) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }
                if($model->share_image && file_exists($path.$model->share_image)) {
                    $oldImage = $path.$model->share_image;
                }

                $model->share_image = md5(time()).'.'.$model->shareImageFile->extension;
                
                if($model->save()) {
                    if(isset($oldImage)) {
                        unlink($oldImage);
                    }
                    $model->shareImageFile->saveAs($path.$model->share_image);
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
