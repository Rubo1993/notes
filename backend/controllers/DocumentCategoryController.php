<?php

namespace backend\controllers;

use Yii;
use common\models\DocumentCategory;
use common\models\DocumentCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentCategoryController implements the CRUD actions for DocumentCategory model.
 */
class DocumentCategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DocumentCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DocumentCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocumentCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imgFile=UploadedFile::getInstance($model,'cat_imgs');
            if (!empty($imgFile)){
                $filePath = Yii::getAlias('@frontend') . '/web/images/uploads/cat_img/';
                $imgaName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $path=$filePath.$imgaName;
                if ($imgFile->saveAs($path)){
                    $model->cat_imgs = $imgaName;
                    $model->save(['cat_imgs']);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DocumentCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->cat_imgs;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imgFile=UploadedFile::getInstance($model,'cat_imgs');
            if (!empty($imgFile)){
                $filePath = Yii::getAlias('@frontend') . '/web/images/uploads/cat_img/';
                $imgaName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $path=$filePath.$imgaName;

                if ($imgFile->saveAs($path)){
                    if (file_exists($old_image)){
                        unset($old_image);
                    } else{
                        $model->cat_imgs = $imgaName;
                        $model->save(['cat_imgs']);
                    }
                }
            }else{
                $model->cat_imgs = $old_image;
                $model->save(['cat_imgs']);
            }




            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocumentCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
