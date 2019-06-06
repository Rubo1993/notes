<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yii2assets\pdfjs\PdfJs;

?>


<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <?= Yii::$app->session->getFlash('success') ?>
    <?php endif; ?>
    <div class="mini_contain">

        <div class="view_title">
            <h4>
                Ծանոթագրություն Նախադիտում
            </h4>
        </div>

        <div class="note_item">
            <div class="note_item_left">
                <!--                --><? //= PdfJs::widget([
                //                    'url' => Url::to(['/']) . $viewInfo['img_url'] . $viewInfo['not_img']
                //                ]); ?>
                <img src="<?= Url::to(['/']) . $viewInfo['img_url'] . $viewInfo['not_img'] ?>" alt="">
            </div>
            <div class=" note_item_right">
                <h4 class="notes_title"><?= $viewInfo['title'] ?></h4>
                <div class=" date_cate_down">
                    <div class=""><?= $viewInfo['categories'] ?></div>
                    <div class="">time</div>
                    <div class=""><?= $viewInfo['downloaded'] ? $viewInfo['downloaded'] : 0 ?> <i
                                class="fas fa-download"></i></div>
                </div>

                <div class="">
                    <p class="price_notes_w"><?= $viewInfo['price'] ?> <span
                                class=""><?= $viewInfo['sumbol'] ?></span></p>
                </div>
                <div class="cart_wishlist">


                    <div class="add_wishlist">

                        <div class="wish_div">
                            <?php if (empty($is_whish)) {
                                ?>
                                <button id="whish_btn_hide" class="wishlist whishlist_btn"
                                        data-url="<?php echo Yii::$app->homeUrl . "author/add" ?>"
                                        data-id="<?= $viewInfo['not_id'] ?>">
                                    Նախընտրելի
                                </button>
                            <? } else {
                                ?>
                                <button id="whish_btn_hide" class="wishlist liked whishlist_btn"
                                        data-url="<?php echo Yii::$app->homeUrl . "author/add" ?>"
                                        data-id="<?= $viewInfo['not_id'] ?>"> Ջնջել
                                </button>
                            <?php }
                            ?>
                        </div>
                        <div class="add_to_cart">
                            <?php if ($cart_btn == true){?>
                            <?php if (empty($cart)) { ?>
                                <a class="note_cart btn btn-lightblue animate" id="add_to_cart"
                                   data-url="<?php echo Yii::$app->homeUrl . "author/addto" ?>"
                                   data-id="<?= $viewInfo['not_id'] ?>">
                                    <i class="fa fa-shopping-cart" id="change_txt"> Add To Cart</i>
                                </a>
                            <?php } else {
                                ?>

                                <a id="cart_message" href="<?= Url::to(['/']) . 'author/cart' ?>"><i
                                            class="fa fa-shopping-cart"></i> Զամբյուղ</a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="down">
<!--                            --><?php //var_dump($download_btn);die();?>
                            <?php if (!empty($download_btn)) {
                                ?>
                                <a href="<?= Url::to(['/']) . 'notes/download/' . $viewInfo['not_slug'] ?>">
                                    <i class="fas fa-download"></i></a>
                                <?php
                            }else{
                                ?>
                                <i class="fas fa-download" title="Please buy later download!"></i>
                                <?php
                            }
                            ?>
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
                    <div class="user_img_r">
                        <a href="<?= Url::to(['/']) . 'author/profile/' . $viewInfo['slug'] ?>">
                            <img class="us_img"
                                 src="<?= Url::to(['/']) . $viewInfo['user_img_url'] . $viewInfo['image'] ?>"
                                 alt="">
                        </a>
                    </div>
                    <div class="download_info">
                        <div class="down_p_title">
                            <h4 class="view_username"><?= $viewInfo['username'] ?></h4>
                        </div>

                        <div class="downlo_info">
                            <p>
                                Բեռնվել է
                                <?= $viewInfo['downloaded'] ? $viewInfo['downloaded'] : 0 ?>
                            </p>
                        </div>
                        <div class="downlo_info">
                            <p>Համալսարան</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--		--><? // } ?>
    </div>
    <div class="similar_note">
        <div class="similar_title">
            <h2>
                Նմանատիպ ծանոթագրություններ
            </h2>
        </div>
        <div class="similar_all">
            <?php foreach ($similar_not as $similar) { ?>
                <div class="similar_part">
                    <a href="<?= Url::to(['/']) . 'notes/view/' . $similar['slug'] ?>">
                        <img src="<?= Url::to(['/']) . $similar['img_url'] . $similar['image'] ?>"
                             class="similar_img" alt="error">
                    </a>
                    <div class="similar_inf">
                        <div class="similar_not_cnt">
                            <a class=""
                               href="<?= Url::to(['/']) . 'notes/view/' . $similar['slug'] ?>">   <?= $similar['title'] ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
