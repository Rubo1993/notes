<?php


namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use common\models\LbCountry;
use yii\web\UploadedFile;

class StudentController extends Controller
{
public function actionProfile($slug = ''){
    $id = Yii::$app->user->id;

    $user = User::findOne($id);
    $currency = LbCountry::find()->asArray()->all();
    $currency = ArrayHelper::map($currency, 'id', 'currency');
    $old_img = $user->image;
    $old_cv = $user->cv;
    $user_img_path = 'user_info/user_' . $id . '/img' . '/';
    $cv_path = 'user_info/user_' . $id . '/cv' . '/';
    $imgFile = UploadedFile::getInstance($user, 'image');
    $cvFile = UploadedFile::getInstance($user, 'cv');
    $user->image = $imgFile;
    $user->cv = $cvFile;
    if ($user->load(Yii::$app->request->post()) && $user->validate()) {

        if (!empty($imgFile)) {
            $filePath = Yii::getAlias('@frontend') . '/web/user_info/user_' . $id . '/img' . '/';

            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $path = $filePath . $imgName;
            if (!file_exists($filePath)) {
                FileHelper::createDirectory($filePath);
            }
            if ($imgFile->saveAs($path)) {
                $user->image = $imgName;
            }
        } else {
            $user->image = $old_img;
        }

        if (!empty($cvFile)) {
            $cvPath = Yii::getAlias('@frontend') . '/web/user_info/user_' . $id . '/cv' . '/';
            $cvName = Yii::$app->security->generateRandomString() . '.' . $cvFile->extension;
            $path = $cvPath . $cvName;
            if (!file_exists($cvPath)) {
                FileHelper::createDirectory($cvPath);
            }
            if ($cvFile->saveAs($path)) {
                $user->cv = $cvName;
            }
        } else {
            $user->cv = $old_cv;
        }

        $user->user_img_url = $user_img_path;
        $user->cv_url = $cv_path;

        try {
            if ($user->save(false)) {
                Yii::$app->session->getFlash('success', 'Անձնական տվյալները թարմացված են');
                $this->redirect(['profile']);
            };
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'app');
            Yii::$app->session->setFlash('error', 'Error');
        }
    }

    if ($user['profession']==1){
    return $this->redirect('/');
}
    return $this->render('profile',[
        'currency'=>$currency,
        'user'=>$user,
    ]);
}

}