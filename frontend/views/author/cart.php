<?php

use yii\helpers\Url;

?>
<div class="container">
    <?php if (!empty($cartinfo)) { ?>
    <h2>
        Զամբյուղ
    </h2>
    <div class="cart_peymant">
        <div class="cart_container">
            <?php foreach ($cartinfo as $ct) { ?>
                <div class="cart_fl">
                    <div class="cart_img">
                        <a href="<?= Url::to(['/']) . 'author/delete/' . $ct['id'] ?>">
                            <i class="fa fa-trash-alt"></i></a>
                        <button class=" whishlist_btn" data-url="<?php echo Yii::$app->homeUrl . "author/add" ?>"
                                data-id="<?= $ct['id'] ?>"><i class="fas fa-heart"></i></button>
                        <a href="<?= Url::to(['/']) . 'notes/view/' . $ct['slug'] ?>">
                            <img class="cart_nt_img" src="<?= Url::to(['/']) . $ct['img_url'] . $ct['image'] ?>"
                                 alt="cart_img">
                        </a>
                    </div>
                    <div class="cart_cont">
                        <a class="cart_cont_title"
                           href="<?= Url::to(['/']) . 'notes/view/' . $ct['slug'] ?>">
                            <span><?= $ct['title'] ?></span>
                        </a>
                        <div class="cart_author">
                    <span class="cart_inf">
                     <?= $ct['categories'] ?>
                    </span>
                            <a class="cart_inf us_marg"
                               href="<?= yii\helpers\Url::to(['/']) . 'author/profile/' . $ct['user_slug'] ?>">
                                <i class="far fa-user"></i> <?= $ct['username'] ?>
                            </a>
                        </div>
                        <p class="cart_text">
                            packages and web page editors now use Lorem Ipsum as their default model text, and a
                            search
                            for
                            'lorem ipsum' will uncover many web sites still in their infancy. Various versions have
                            evolved over
                            the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="cart_infos">
            <div class="products_inf">
                <div>
                    <span>Նոթերի քանակը <?= $count ? $count : '' ?></span>
                </div>
                <div>
                    <span> Ընդամենը <?= $total ? $total : '' ?></span>
                    <br>
                    <small>(ըստ Ձեր արժույթի)</small>
                </div>
                <div>
                    <span> Ընդամենը</span>
                    <br>
                    <small>(վճարման արժույթով)</small>
                </div>
                <div class="cart_logos">
                    <img src="<?= Url::to(['/']) . 'images/uploads/icons/8-Cards.jpg' ?>" alt="">
                </div>
                <div class="checkout_more">
                    <div class="button_cont ">
                        <a class="example_b" href="<?= Url::to(['/']) . 'notes/need' ?>"
                           rel="nofollow noopener">Add more</a>
                    </div>
                    <div class="button_cont">
                        <a class="example_b" href="<?= Url::to(['/']) . 'author/pay' ?>" rel="nofollow noopener">checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {
            ?>
            <h2>Զամբյուղը դատարկ է</h2>
        <?php } ?>
    </div>


