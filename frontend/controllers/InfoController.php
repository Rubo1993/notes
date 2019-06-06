<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.04.2019
 * Time: 11:39
 */

namespace frontend\controllers;

use common\models\DocumentCategory;
use common\models\LbCountry;
use yii\web\Controller;
use Yii;
use common\models\User;
use yii\web\UploadedFile;
use common\models\Informations;
use common\models\Universities;
use common\models\Chair;
use common\models\Faculty;
use common\models\Specialization;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class InfoController extends Controller
{
    public function actionIndex()
    {
        $postinfo = Yii::$app->request->post();
        $id = Yii::$app->user->id;
        $user_img_path = 'user_info/user_' . $id . '/img' . '/';
        $cv_path = 'user_info/user_' . $id . '/cv' . '/';
        $user = User::findOne($id);
        if ($user->profession == 0){
            return $this->redirect('/');
        }
        $univer = ArrayHelper::map(Universities::find()->asArray()->all(), 'id', 'name');
        $faculty = ArrayHelper::map(Faculty::find()->where(['univer_id' => '1'])->asArray()->all(), 'id', 'name');
        $chair = ArrayHelper::map(Chair::find()->where(['faculty_id' => '1'])->asArray()->all(), 'id', 'name');
        $specializ = ArrayHelper::map(Specialization::find()->where(['chair_id' => '1'])->asArray()->all(), 'id', 'name');
        $currency = ArrayHelper::map(LbCountry::find()->asArray()->all(), 'id', 'currency');
        $preferenc = DocumentCategory::find()->asArray()->all();
        $old_img = $user->image;
        $old_cv = $user->cv;
        $informations = Informations::findOne(['user_id' => $id]);
        $informations = !empty($informations) ? $informations : new Informations();
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
//                if (!empty($old_img) && file_exists($path)){
//                    unlink($filePath.$old_img);
//                }

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
                if (!empty($old_cv)){
                    unlink($cvPath.$old_cv);
                }
            } else {
                $user->cv = $old_cv;
            }

            $user->user_img_url = $user_img_path;
            $user->cv_url = $cv_path;

            try {
                if ($user->save(false)) {
                    Yii::$app->session->getFlash('success', 'Անձնական տվյալները թարմացված են');
                    $this->redirect(['index']);
                };
            } catch (\Exception $e) {
                Yii::error($e->getMessage(), 'app');
                Yii::$app->session->setFlash('error', 'Error');
            }
        }
        $informations->faculty_id=$univer;
        if ($informations->load(\Yii::$app->request->post())) {
            $informations->user_id = Yii::$app->user->id;
            $informations->save();
        }

        return $this->render('index', [
            "user" => $user,
            'univer' => $univer,
            'informations' => $informations,
            'faculty' => $faculty,
            'chair' => $chair,
            'specializ' => $specializ,
            'preferenc' => $preferenc,
            'currency' => $currency
        ]);
    }

    public function actionPreference($favorite)
    {
        Yii::$app->controller->enableCsrfValidation = false;
        $id = Yii::$app->user->id;
        $preferenc = Informations::find()->where(['user_id' => $id])->one();
        $preferenc = !empty($preferenc) ? $preferenc : new Informations();
        $preferenc->user_id = $id;
        $preferenc->preferenc_id = $favorite;
        try {
            if ($preferenc->save(false)) {
                Yii::$app->session->setFlash('success', 'Նախասիրություններն թարմացվել են');
                return $this->redirect('index');
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'app');
            Yii::$app->session->setFlash('error', 'Error');
        }
        return $this->render('index',[
            'preferenc'=>$preferenc,
        ]);
//        exit();
    }


}
