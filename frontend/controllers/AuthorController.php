<?php

namespace frontend\controllers;


use common\models\Cart;
use common\models\Note;
use common\models\Orders;
use yii\web\Controller;
use common\models\User;
use common\models\Whishlist;
use Yii;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class AuthorController extends Controller
{
    public function actionProfile($slug = '')
    {
        $id = Yii::$app->user->id;
        $update_btn = false;

        $author = User::find()->where(['slug' => $slug])
            ->asArray()->one();
        $all_notes = Note::find()->select('note.*,lb_country.*')
            ->innerJoin('lb_country', 'note.curency_id = lb_country.id')
            ->where(['note.user_id' => $author['id']]);

        if ($author['id'] != $id) {
            $all_notes = $all_notes->andWhere(['!=', 'status', '0']);
        }

        $sum = $all_notes->sum('downloaded');

        $all_notes = $all_notes->asArray()->all();

        if ($author['id'] == $id) {
            $update_btn = true;
        }
        return $this->render('profile', [
            'sum' => $sum,
            'update_btn' => $update_btn,
            'author' => $author,
            'all_notes' => $all_notes
        ]);
    }

    public function actionWhishlist($slug = '')
    {
        $id = Yii::$app->user->id;
        $wishView = Whishlist::find()
            ->select('note.*,note.id as note_id,whishlist.*')
            ->innerJoin('note', 'whishlist.whish_note_id=note.id')
            ->where(['whishlist.whish_user_id' => $id]);
        $pagination = new Pagination(['totalCount' => $wishView->count(),'pageSize' =>1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $wishView,
        ]);
        $wishView = $wishView->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()->all();

        $count = count($wishView);
        return $this->render('whishlist', [
            'pagination'=>$pagination,
            'dataProvider'=>$dataProvider,
            'wishView' => $wishView,
            'count' => $count,
        ]);

    }

    public function actionAdd($id)
    {
        if (Yii::$app->request->isAjax) {
            $userId = Yii::$app->user->id;
            $wishlistinf = Whishlist::find()
                ->where(['whish_note_id' => $id])
                ->andWhere(['whish_user_id' => $userId])->one();
            if (empty($wishlistinf)) {
                $whishs = new Whishlist();
                $whishs->whish_user_id = $userId;
                $whishs->whish_note_id = $id;
                if ($whishs->save()) {
                    return 'Note in whishlist';
                } else {
                    return 'no save';

                }
            } else {
                $wishlistinf->delete();
                return "Note deleted";
            }

        }


    }

    public function actionDelwhish($id)
    {
        if (Yii::$app->request->isAjax) {
            $userId = Yii::$app->user->id;
            $in_whish = Whishlist::find()
                ->where(['whish_note_id' => $id])
                ->andWhere(['whish_user_id' => $userId])->one();
            var_dump($in_whish);
            die();
        }
    }

    public function actionCart($slug = '')
    {
        $count = 0;
        $total = 0;
        $id = Yii::$app->user->id;
        $cartinfo = Cart::find()->select('cart.*,note.*,lb_user.username,lb_user.slug as user_slug,document_category.categories,lb_country.sumbol')
            ->innerJoin('note', 'note.id=cart.product_id')
            ->innerJoin('lb_user', 'cart.user_id=lb_user.id')
            ->innerJoin('document_category', 'document_category.id=note.cat_id')
            ->innerJoin('lb_country', 'note.curency_id=lb_country.id')
            ->where(['cart.user_id' => $id])
            ->asArray()->all();

        if (!empty($cartinfo)) {
            $count = count($cartinfo);
            foreach ($cartinfo as $cart) {
                $total += $cart['price'];

            }
        }else{
            return $this->redirect('/notes/need');
        }

        return $this->render('cart', [
            'cartinfo' => $cartinfo,
            'count' => $count,
            'total' => $total
        ]);
    }

    public function actionAddto($id = '')
    {

        $userid = Yii::$app->user->id;
        $note = Note::find()->where(['id' => $id])->one();
        $cart = Cart::find()->where(['product_id' => $id])->one();
        if (!empty($cart)) {
            $cart['product_id'] = $note['id'];
            if (Yii::$app->user->isGuest) {

            } else {
                $cart['user_id'] = $userid;
            }
            $cart->save();
        } else {
            $cart = new Cart();
            $cart['product_id'] = $note['id'];
            $cart['user_id'] = $userid;
            $cart->save();
        }
        return 'product_in_cart';
    }

    public function actionDelete($id = '')
    {

        if (!empty($id)) {
            Cart::deleteAll(['product_id' => $id]);
        }
        return $this->redirect('/author/cart');
    }
    public function actionDownloaded(){
//        if ( ! Yii::$app->user->isGuest ) {
//            return $this->goHome();
//        }
        $user_id = Yii::$app->user->id;
        $downloaded= Orders::find()->select('note.*,orders.*')
            ->innerJoin('note','orders.product_id=note.id')
            ->where(['orders.user_id'=>$user_id])
            ->asArray()->all();

        return $this->render('downloaded',[
            'downloaded'=>$downloaded,
        ]);
    }

}
