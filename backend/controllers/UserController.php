<?php


namespace backend\controllers;


use common\models\User;
use function foo\func;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UserController extends \lowbase\user\controllers\UserController
{
    public function actionUpdate($id)
    {
        $model = User::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('user', 'Запрошенная страница не найдена.'));
        }
        if ($model->birthday) {
            $date = new \DateTime($model->birthday);
            $model->birthday = $date->format('d.m.Y');
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Данные профиля обновлены.'));
                return $this->redirect(['update', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }
}