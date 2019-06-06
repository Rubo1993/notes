<?php

namespace frontend\controllers;


use common\models\Informations;
use common\models\Note;
use common\models\User;
use yii\web\Controller;
use common\models\Messages;
use Yii;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class ReviewController extends Controller
{

    public function actionNotes()
    {
        $id = Yii::$app->user->id;
        $user = User::find()->where(['id' => $id])->asArray()->one();
        if ($user['profession'] == '0') {
            return $this->redirect('/error');
        }
        $preferenc_id = Informations::find()->where(['user_id' => $id])->asArray()->one();
        $preferenc_id = json_decode($preferenc_id['preferenc_id']);
        if (!empty($preferenc_id)) {
            $viewNot = Note::find()->where(['cat_id' => $preferenc_id])
                ->andWhere(['!=', 'user_id', $id])
                ->andWhere(['=', 'preview_id', '0'])
                ->andWhere(['=', 'status', '0']) ;


                $pagination = new Pagination(['totalCount' => $viewNot->count(),'pageSize' =>5]);
            $dataProvider = new ActiveDataProvider([
                'query' => $viewNot,
            ]);
            $viewNot = $viewNot->offset($pagination->offset)
                ->limit($pagination->limit)->asArray()->all();
        } else {
            $viewNot = '';
        }
        return $this->render('notes', [
            'dataProvider' => $dataProvider,
            'pagination'=>$pagination,
            'viewNot' => $viewNot,
        ]);
    }


    public function actionChus($id)
    {
        if (Yii::$app->request->isAjax) {
            $user_id = Yii::$app->user->id;
            $chuse = Note::findOne(['id' => $id]);
            $chuse->preview_id = $user_id;
            if ($chuse->save(false)) {
                return 'note selected';
            } else {
                return 'no note selected';
            }

        }

    }

    public function actionCheck()
    {
        $user_id = Yii::$app->user->identity->id;
        $user = User::find()->where(['id' => $user_id])->asArray()->one();
        if ($user['profession'] == '0') {
            return $this->redirect('/error');
        }
        $preferenc_id = Informations::find()
            ->where(['user_id' => $user_id])
            ->asArray()->one();
        $preferenc_id = json_decode($preferenc_id['preferenc_id']);
        $viewNot = Note::find()->where(['cat_id' => $preferenc_id])
            ->andWhere(['preview_id' => $user_id])
            ->andWhere(['status' => 0]);
        $pagination = new Pagination(['totalCount' => $viewNot->count(),'pageSize' =>5]);
        $dataProvider = new ActiveDataProvider([
            'query' => $viewNot,
        ]);
        $viewNot = $viewNot->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()->all();


        return $this->render('check', [
            'dataProvider' => $dataProvider,
            'pagination'=>$pagination,
            'viewNot' => $viewNot,
        ]);
    }

    public function actionEdit($slug)
    {
        $post = Yii::$app->request->post();
        $user_id = Yii::$app->user->identity->id;
        $model = new Messages();
        $viewInfo = Note::find()->select('note.*,note.image as not_img,note.slug as not_slug,note.status as not_status,note.id as not_id,document_category.*,document_type.*,universities.*,languages.*,lb_user.*,lb_country.sumbol,years.year')
            ->innerJoin('document_category', 'note.cat_id=document_category.id')
            ->innerJoin('document_type', 'note.type_id = document_type.id')
            ->innerJoin('languages', 'note.language_id = languages.id')
            ->innerJoin('universities', 'note.univer_id = universities.id')
            ->innerJoin('lb_user', 'lb_user.id = note.user_id')
            ->innerJoin('lb_country', 'note.curency_id = lb_country.id')
            ->innerJoin('years', 'note.year_authored = years.id')
            ->where(['note.slug' => $slug])
            ->asArray()->one();
        if ($viewInfo['not_status'] != 0) {
            return $this->redirect('/review/check');
        }
        if (!empty($post)) {
            $message = $post['Messages']['message'];
        }
        if ($model->load(Yii::$app->request->post())) {

            $profesor_name = User::find()->where(['id' => $user_id])->asArray()->one();
            $model->profesor_id = $user_id;
            $model->student_id = $viewInfo['user_id'];
            $model->email = $profesor_name['email'];
            if ($model->save(false)) {
                \Yii::$app->mailer->compose('messages', ['message' => $message,
                    'professor' => $profesor_name,
                ])
                    ->setFrom(['sport-199368@mail.ru' => 'notest.am'])
                    ->setTo($viewInfo['email'])
                    ->setSubject('Note')
                    ->send();
                Yii::$app->session->setFlash('success', 'Հաղորդագրությունն ուղղարկված է ' . $viewInfo["username"] . '-ին');
                return $this->refresh();
            };

        }

        return $this->render('edit', [
            'viewInfo' => $viewInfo,
            'model' => $model,
        ]);
    }


}