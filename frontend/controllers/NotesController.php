<?php

namespace frontend\controllers;

use common\models\Cart;
use common\models\DocumentCategory;
use common\models\DocumentType;
use common\models\Informations;
use common\models\Languages;
use common\models\LbCountry;
use common\models\Note;
use common\models\Orders;
use common\models\User;
use common\models\Years;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Universities;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use common\models\Whishlist;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class NotesController extends Controller
{
    public function actionSell()
    {
        $note = new Note();
        $user_id = Yii::$app->user->id;
        $img_url = 'note/' . $user_id . '/' . 'scren_img' . '/';
        $note_url = 'note/' . $user_id . '/' . $user_id . "_note" . '/';
        $univer = ArrayHelper::map(Universities::find()->asArray()->all(), 'id', 'name');
        $language = ArrayHelper::map(Languages::find()->asArray()->all(), 'id', 'language');
        $type = ArrayHelper::map(DocumentType::find()->asArray()->all(), 'id', 'type');
        $country = ArrayHelper::map(LbCountry::find()->asArray()->all(), 'id', 'currency');
        $year = ArrayHelper::map(Years::find()->asArray()->all(), 'id', 'year');
        $category = ArrayHelper::map(DocumentCategory::find()->asArray()->all(), 'id', 'categories');
        $old_img = $note->image;
        $old_note = $note->notes;
        $imgFile = UploadedFile::getInstance($note, 'image');
        $noteFile = UploadedFile::getInstance($note, 'notes');

        if ($note->load(\Yii::$app->request->post())) {
            $note->image = $imgFile;
            $note->notes = $noteFile;
            if ($note->validate()) {
                $note->user_id = $user_id;
                if (!empty($imgFile)) {

                    $filePath = Yii::getAlias('@frontend') . '/web/note/' . $user_id . '/' . 'scren_img' . '/';
                    $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                    $path = $filePath . $imgName;
                    if (!file_exists($filePath)) {
                        FileHelper::createDirectory($filePath);

                    }
                    if ($imgFile->saveAs($path)) {
                        $note->image = $imgName;
                    }
                } else {
                    $note->image = $old_img;
                }


                if (!empty($noteFile)) {
                    $notPath = Yii::getAlias('@frontend') . '/web/note/' . $user_id . '/' . $user_id . '_note' . '/';
                    $noteName = Yii::$app->security->generateRandomString() . '.' . $noteFile->extension;
                    $path = $notPath . $noteName;
                    if (!file_exists($notPath)) {
                        FileHelper::createDirectory($notPath);
                    }
                    if ($noteFile->saveAs($path)) {
                        $note->notes = $noteName;
                    }
                } else {
                    $note->notes = $old_note;
                }

                $note->img_url = $img_url;
                $note->note_url = $note_url;

                try {
                    if ($note->save(false)) {
                        Yii::$app->session->setFlash('success', 'Նոթը հաջողությամբ ավելացվել է');
                    };
                } catch (\Exception $e) {
                    Yii::error($e->getMessage(), 'app');
                    Yii::$app->session->setFlash('error', 'Error');
                }
            }
        }
//        print_r($note->errors);die;
        return $this->render('sell', [
            'note' => $note,
            'univer' => $univer,
            'language' => $language,
            'type' => $type,
            'country' => $country,
            'year' => $year,
            'category' => $category,
        ]);
    }

    public function actionUpdate($slug = '')
    {
        $post = Yii::$app->request->post();
        $id = Yii::$app->user->id;

        if (!empty($slug)) {
            $note = Note::findOne(['slug' => $slug]);
        } else {
            $note = Note::findOne(['slug' =>
                $post['slug']]);
        }
        $old_img = $note->image;
        $old_notes = $note->notes;
        $imgFile = UploadedFile::getInstance($note, 'image');
        $noteFile = UploadedFile::getInstance($note, 'notes');
        $note->image = $imgFile;
        $note->notes = $noteFile;

        if ($note['user_id'] != $id) {
            return $this->redirect('/');
        }
        $univer = ArrayHelper::map(Universities::find()->asArray()->all(), 'id', 'name');
        $language = ArrayHelper::map(Languages::find()->asArray()->all(), 'id', 'language');
        $type = ArrayHelper::map(DocumentType::find()->asArray()->all(), 'id', 'type');
        $category = ArrayHelper::map(DocumentCategory::find()->asArray()->all(), 'id', 'categories');
        $country = ArrayHelper::map(LbCountry::find()->asArray()->all(), 'id', 'name');
        $year = ArrayHelper::map(Years::find()->asArray()->all(), 'id', 'year');
        if (!empty($note)) {
            if ($note->load(Yii::$app->request->post()) && $note->validate()) {

                if (!empty($imgFile)) {
                    $filePath = $note->img_url;
                    $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                    $path = $filePath . $imgName;
                    if (!file_exists($filePath)) {
                        FileHelper::createDirectory($filePath);
                    }
                    if ($imgFile->saveAs($path)) {
                        $note->image = $imgName;
                    }
                } else {
                    $note->image = $old_img;
                }


                if (!empty($noteFile)) {
                    $notePath = $note->note_url;
                    $noteName = Yii::$app->security->generateRandomString() . '.' . $noteFile->extension;
                    $path = $notePath . $noteName;
                    if (!file_exists($notePath)) {
                        FileHelper::createDirectory($notePath);
                    }
                    if ($noteFile->saveAs($path)) {
                        $note->notes = $noteName;
                    }
                } else {
                    $note->notes = $old_notes;
                }


                if ($note->save(false)) {
                    Yii::$app->session->setFlash('success', 'Նոթը թարմացվել է');
                } else {
                    echo 'das';
                };
            }
        }

        if (empty($note)) {
            return $this->redirect('/author/profile');
        }

        return $this->render('update', [
            'univer' => $univer,
            'language' => $language,
            'type' => $type,
            'country' => $country,
            'year' => $year,
            'category' => $category,
            'note' => $note,
        ]);
    }

    public function actionNeed($id = '')
    {
        $viewNot = LbCountry::find()->select('lb_country.*,note.*')
            ->innerJoin('note', 'note.curency_id = lb_country.id')->where(['!=', 'status', 0]);
        $data = DocumentType::find()->asArray()->all();
        $data = ArrayHelper::map($data, 'id', 'type');
        $language = ArrayHelper::map(Languages::find()->asArray()->all(), 'id', 'language');
        $univer = ArrayHelper::map(Universities::find()->asArray()->all(), 'id', 'name');
        $country = ArrayHelper::map(LbCountry::find()->asArray()->all(), 'id', 'name');
        $category = ArrayHelper::map(DocumentCategory::find()->asArray()->all(), 'id', 'categories');
        $year = ArrayHelper::map(Years::find()->asArray()->all(), 'id', 'year');
        $querys = Yii::$app->request->get();
        if (!empty($querys['not_search'])) {
            $name = strip_tags($querys['not_search']);
            $viewNot = $viewNot->andWhere(['like', 'title', $name]);
        }
        if (!empty($querys['type_id'])) {
            $viewNot = $viewNot->andWhere(['type_id' => $querys['type_id']]);
        }
        if (!empty($querys['language_id'])) {
            $viewNot = $viewNot->andWhere(['language_id' => $querys['language_id']]);
        }
        if (!empty($querys['univer_id'])) {
            $viewNot = $viewNot->andWhere(['univer_id' => $querys['univer_id']]);
        }
        if (!empty($querys['category_id'])) {
            $viewNot = $viewNot->andWhere(['cat_id' => $querys['category_id']]);
        }
        if (!empty($querys['year_id'])) {
            $viewNot = $viewNot->andWhere(['year_authored' => $querys['year_id']]);
        }
        if (!empty($id)) {
            $viewNot = $viewNot->andWhere(['cat_id' => $id]);
        }

        $max_price = Note::find()->max('price');
        $min_price = Note::find()->min('price');
        if (!empty($querys['price'])) {
            $interval = explode(',', $querys['price']);
            $viewNot = $viewNot->andWhere(['>=', 'price', (int)$interval[0]])->andWhere(['<=', 'price', (int)$interval[1]]);
            $interval_start = $interval[0];
            $interval_end = $interval[1];
        } else {
            $interval_start = $min_price;
            $interval_end = $max_price;
        }
        $max_length = Note::find()->max('length');
        $min_length = Note::find()->min('length');
        if (!empty($querys['length'])) {
            $note_length = explode(',', $querys['length']);
            $length_start = $note_length[0];
            $length_end = $note_length[1];
            $viewNot = $viewNot->andWhere(['>=', 'length', (int)$note_length[0]])->andWhere(['<=', 'length', (int)$note_length[1]]);
        } else {
            $length_start = $min_length;
            $length_end = $max_length;
        }
//        $viewNot = $viewNot->asArray()->all();
        $pagination = new Pagination(['totalCount' => $viewNot->count(), 'pageSize' => 2]);
        $dataProvider = new ActiveDataProvider([
            'query' => $viewNot,
        ]);
        $viewNot = $viewNot->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()->all();

        return $this->render('need', [
            'dataProvider' => $dataProvider,
            'pagination' => $pagination,
            'viewNot' => $viewNot,
            'data' => $data,
            'language' => $language,
            'univer' => $univer,
            'country' => $country,
            'category' => $category,
            'year' => $year,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'interval_start' => $interval_start,
            'interval_end' => $interval_end,
            'max_length' => $max_length,
            'min_length' => $min_length,
            'length_start' => $length_start,
            'length_end' => $length_end,
            'querys' => $querys,
        ]);
    }

    public function actionView($slug = '')
    {
        if (Yii::$app->user->getIsGuest()) {
            return $this->redirect(array('site/login'));
        } else {
            $download_btn = false;
            $user_id = Yii::$app->user->id;
            $user= User::findOne([$user_id]);
            $download = Note::findOne(['slug' => $slug]);
            $cart_btn=true;
            $professions = Informations::find()->where(['user_id' => $user_id])->asArray()->one();
            $professions = json_decode($professions['preferenc_id']);
            $bought = false;

            $viewInfo = Note::find()->select('note.*,note.image as not_img,note.status as not_status,note.slug as not_slug,note.id as not_id,document_category.*,document_type.*,universities.*,languages.*,lb_user.*,lb_country.sumbol,years.year')
                ->innerJoin('document_category', 'note.cat_id=document_category.id')
                ->innerJoin('document_type', 'note.type_id = document_type.id')
                ->innerJoin('languages', 'note.language_id = languages.id')
                ->innerJoin('universities', 'note.univer_id = universities.id')
                ->innerJoin('lb_user', 'lb_user.id = note.user_id')
                ->innerJoin('lb_country', 'note.curency_id = lb_country.id')
                ->innerJoin('years', 'note.year_authored = years.id')
                ->where(['note.slug' => $slug])
                ->asArray()->one();

            $purchased = Orders::find()->where(['user_id' => $user_id])
                ->andWhere(['product_id' => $viewInfo['not_id']])
                ->asArray()->one();
            if (!empty($purchased) || $user['profession'] !=1 && $download['preview_id'] != $user_id) {
                $download_btn = true;
            }
            if ($viewInfo['not_status']==0 || $viewInfo['preview_id']==0){
                $cart_btn = false;
            }
            $is_whish = Whishlist::find()->where(['whish_user_id' => $user_id])
                ->andWhere(['whish_note_id' => $viewInfo['not_id']])->asArray()->one();
            $cart = Cart::find()->where(['user_id' => $user_id])
                ->andWhere(['product_id' => $viewInfo['not_id']])
                ->asArray()->one();
            $similar_not = Note::find()->select('Note.*')
                ->andWhere(['type_id' => $viewInfo['type_id']])
                ->andWhere(['cat_id' => $viewInfo['cat_id']])
                ->andWhere(['!=', 'id', $viewInfo['not_id']])
                ->orderBy(['rand()' => SORT_DESC])->limit(4)
                ->asArray()->all();
        }
        if ($viewInfo['preview_id'] == $user_id) {
            $bought = true;
        }

        $user = User::findOne([$user_id]);
        if ($viewInfo['preview_id'] == 0 && $viewInfo['not_status'] == 0 && $user['profession'] == 0) {
            throw new \yii\web\NotFoundHttpException('Invalid url');
        }
        $purchased = Orders::find()->where(['user_id' => $user_id])
            ->andWhere(['product_id' => $viewInfo['not_id']])
            ->asArray()->one();
        return $this->render('view', [
            'download_btn'=>$download_btn,
            'cart_btn'=>$cart_btn,
            'bought' => $bought,
            'viewInfo' => $viewInfo,
            'similar_not' => $similar_not,
            'cart' => $cart,
            'purchased' => $purchased,
            'is_whish' => $is_whish,
        ]);
    }

    public function actionDownload( $slug = '')
    {
        $user_id = Yii::$app->user->id;
        $user = User::findOne([$user_id]);
        $download = Note::findOne(['slug' => $slug]);
        $purchased = Orders::find()->where(['user_id' => $user_id])
            ->andWhere(['product_id' => $download['id']])
            ->asArray()->one();

        if (!empty($purchased) || $user['profession'] == 1 && $download['preview_id'] == $user_id ) {
            $path = Yii::getAlias('@frontend') . '/web/' . $download->note_url . $download->notes;
//            if ((file_exists($path))) {
                $succes = Yii::$app->response->sendFile($path);
                if ($succes) {
                    $download->downloaded = $download->downloaded + 1;
                    $download->save(false);
                    return $succes;
                }
//            } else {
//                throw new NotFoundHttpException("can't find file");
//            }
        } else {
//            var_dump('da');
//            throw new NotFoundHttpException("can't find {$download['title']} file");
        }
    }

    public function actionPrepare($id = '')
    {

        $user_id = Yii::$app->user->id;
        $not = Note::findOne(['id' => $id]);
        if (Yii::$app->request->isAjax) {
            if (!empty($not)) {
                $not->status = $user_id;
                if ($not->save(false)) {
                    return 'not is ready';
                };
            }
        }
    }
}