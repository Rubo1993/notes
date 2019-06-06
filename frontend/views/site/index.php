<?php

/* @var $this yii\web\View */

$this->title = 'NOTEST';

use yii\helpers\Url;
use kartik\social\FacebookPlugin;

?>
<!--Search part start-->
<div class="site-index">
    <!--background img-->
    <div class="s130 top_bg"
         style="background-image: url(<?= Url::to(['/']) . 'images/uploads/all/gl_result.jpg' ?>);background-size: cover">
        <!--/background img-->
        <form method="get" action="<?= Url::to(['/notes/need/']) ?>">
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <input name="not_search" id="search" type="text" placeholder="Ի՞նչ ես դու փնտրում"/>
                </div>
                <div class="input-field second-wrap">
                    <input type="submit" class="btn-search" value="Փնտրել">
                </div>
            </div>
        </form>
    </div>
    <!--/Search part-->
    <!--Work buyers start-->

    <div class="hit-title">
        <p>
            Work buyers
        </p>
    </div>
    <div class="hit-bb"></div>

    <div class="search_steps flex_tw">
        <div class="steps_parts">
            <img class="icons_cs" src="<?= Url::to(['/']) . 'images/uploads/icons/69e0d01c.png' ?>"
                 alt="no img">

            <h3>
                Նշման որոնում
            </h3>
            <p>
                <b>
                    Գտեք ձեր լավագույն ուսումնական ռեսուրսները անմիջապես ձեր դասընթացների համար
                </b>
            </p>
        </div>

        <div class="steps_parts">
            <img class="icons_cs" src="<?= Url::to(['/']) . 'images/uploads/icons/user_icon.png' ?>"
                 alt="no img">
            <h3>
                Նշման որոնում
            </h3>
            <p>
                <b>
                    Գտեք ձեր լավագույն ուսումնական ռեսուրսները անմիջապես ձեր դասընթացների համար
                </b>
            </p>
        </div>
    </div>
    <!--/Work buyers-->
    <!--Work sellers start-->
    <div class="hit-title">
        <p>
            WORKS SELLERS
        </p>
    </div>
    <div class="hit-bb"></div>

    <div class="search_steps">
        <div class="steps_parts">
            <img class="icons_cs" src="<?= Url::to(['/']) . 'images/uploads/icons/69e0d01c.png' ?>"
                 alt="no img">
            <h3>
                Նշման որոնում
            </h3>
            <p>
                <b>
                    Գտեք ձեր լավագույն ուսումնական ռեսուրսները անմիջապես ձեր դասընթացների համար
                </b>
            </p>
        </div>

        <div class="steps_parts">
            <img class="icons_cs" src="<?= Url::to(['/']) . 'images/uploads/icons/user_icon.png' ?>"
                 alt="no img">
            <h3>
                Նշման որոնում
            </h3>
            <p>
                <b>
                    Գտեք ձեր լավագույն ուսումնական ռեսուրսները անմիջապես ձեր դասընթացների համար
                </b>
            </p>
        </div>
        <div class="steps_parts">
            <img class="icons_cs" src="<?= Url::to(['/']) . 'images/uploads/icons/user_icon.png' ?>"
                 alt="no img">
            <h3>
                Նշման որոնում
            </h3>
            <p>
                <b>
                    Գտեք ձեր լավագույն ուսումնական ռեսուրսները անմիջապես ձեր դասընթացների համար
                </b>
            </p>
        </div>
    </div>
    <!--    /Work sellers-->
    <!--    Notes categories start-->
    <div class="notes_cat">
        <div class="cat_title">
            <h2 class="cat_btitle">Lorem Ipsum It is a Lorem</h2>
            <p class="min_title">Featured Categories</p>
        </div>
        <div class="all_notes">
            <?php if (!empty($category)) {
                foreach ($category as $cat) {
                    ?>
                    <figure class="notes_sec">
                        <div class="cut_bt_it">
                            <div>
                                <a href="<?= Url::to(['/']) . 'notes/need/' . $cat['id'] ?>" class="cat_but btn btn-3">
                                    <span class="cat_btn_text">Ավելի․․․</span>
                                    <span class="round"><i class="fa fa-chevron-right"></i></span>
                                </a>
                            </div>
                        </div>
                        <img class="not_img" src="<?= Url::to(['/']) . 'images/uploads/all/notes12.svg' ?>"
                             alt="error">
                        <h2 class="cat_dsc"><?= $cat['categories'] ?></h2>
                    </figure>

                    <?php
                }
            } ?>
        </div>
    </div>
    <!--    /Notes categories-->
    <!--Started note-->
    <?php if ((Yii::$app->user->isGuest)) { ?>
        <div class="get_notes">
            <div class="mini_not">
                <h2 class="centr_title">Սկսեք ծանոթագրություններով</h2>
            </div>
            <div class="get_flex">
                <div class="two_col">
                    <img src="<?= Url::to(['/']) . 'images/uploads/all/get_free_access.svg' ?>"
                         alt="error_img">
                    <div class="login_bt">
                        <a href="<?= Url::to(['/']),'site/signup'?>">Գրանցվել Ուսանող</a>
                    </div>
                </div>
                <div class="two_col">
                    <img src="<?= Url::to(['/']) . 'images/uploads/all/get_free_access.svg' ?>"
                         alt="error_img">
                    <div class="login_bt">
                        <a href="<?= Url::to(['/']),'site/signup'?>">Գրանցվել Դասախոս</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--/Started note-->
</div>
