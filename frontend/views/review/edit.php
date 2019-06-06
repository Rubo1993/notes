<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="container">
    <div class="mini_contain">
        <div class="view_title">
            <h4>
                Ծանոթագրություն Նախադիտում
            </h4>
        </div>
        <div class="note_item">
            <div class="note_item_left">
                <img class="" src="<?= Url::to(['/']) . $viewInfo['img_url'] . $viewInfo['not_img'] ?>" alt="">
            </div>
            <div class="note_item_right">
<?php //   var_dump($viewInfo);die();?>
                <h4 class="notes_title"><?= $viewInfo['title'] ?></h4>
                <div class=" date_cate_down">
                    <div class=""><?= $viewInfo['categories'] ?></div>
                    <div class="">time</div>
                </div>
                <div class="">
                    <p class="price_notes_w"><?= $viewInfo['price'] ?> <span
                                class=""><?= $viewInfo['sumbol'] ?></span></p>
                </div>
                <div class="cart_wishlist">
                    <div class="add_wishlist">
                        <div class="wish_div">
                            <button class="wishlist whishlist_btn"
                                    data-url="<?php echo Yii::$app->homeUrl . "author/add" ?>"
                                    data-id="<?= $viewInfo['not_id'] ?>">Ցանկություն
                            </button>
                        </div>
                        <div class="add_to_cart">
                            <button class="note_cart btn btn-lightblue animate prepare_btns not_is_ready" id="prepare"
                                    data-url="<?php echo Yii::$app->homeUrl . "notes/prepare" ?>"
                                    data-id="<?= $viewInfo['not_id'] ?>">Ստուգված է
                            </button>
                        </div>
                        <div class="down">
                            <a href="<?= Url::to(['/']) . 'notes/download/' . $viewInfo['not_slug'] ?>">
                                <i class="fas fa-download"></i></a>
                        </div>
                    </div>
                </div>
                <div class="view-page-info">
                    <p>Համալսարան <span class="bold"> ։ <?= $viewInfo['name'] ?></span></p>
                    <p>Լեզու <span class="bold"> ։ <?= $viewInfo['language'] ?></span></p>
                    <p>Տարի <span class="bold"> ։ <?= $viewInfo['year'] ?></span></p>
                    <p>Էջեր <span class="bold"> ։ <?= $viewInfo['length'] ?></span></p>
                    <p>Տիպ <span class="bold"> ։ <?= $viewInfo['type'] ?></span></p>
                </div>
                <div class="note_description">
                    <p><?= $viewInfo['description'] ?></p>
                </div>
                <div class="user_down_info">
                    <div class="down_p_title">
                        <h4 class="view_username"><?= $viewInfo['username'] ?></h4>
                    </div>
                    <div class="user_img_r" id="edit_user">
                        <a href="<?= Url::to(['/']) . 'author/profile/' . $viewInfo['slug'] ?>">
                            <img class="us_img"
                                 src="<?= Url::to(['/']) . $viewInfo['user_img_url'] . $viewInfo['image'] ?>"
                                 alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="message_items">
        <div class="row">
            <div class="col-12">
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'akame-contact-form border-0 p-0']); ?>
                <?= $form->field($model, 'prof_name')->textInput(['autofocus' => true,
                    'placeholder' => 'Ваше имя ', 'class' => 'form-control mb-30'])->label('Имя') ?>
                <?= $form->field($model, 'message')->textarea(['rows' => 6, 'placeholder' => 'Текст сообщения '])->label('Сообщение') ?>
                <div class="form-group text-center">
                    <?= Html::submitButton('Отправить ', ['class' => 'btn akame-btn btn-3 mt-15 active', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>




