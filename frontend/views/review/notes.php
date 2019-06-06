<?php

use yii\widgets\Pjax;
use yii\helpers\Url;

?>
<div class="privew_container">
    <?php if (!empty($viewNot)) {
    ?>
    <div class="preview_title">
        <h2>
            Նոթերի Վերանայում
        </h2>
    </div>
    <!--        --><?php //Pjax::begin(); ?>
    <div class="note_review_imtes">
        <?php foreach ($viewNot as $not) {  ?>
        <div class="review_item review_note_js">
            <div class="review_blog">
                <a href="<?= Url::to(['/']) . 'notes/view/' . $not['slug'] ?>">
                    <h4 class="review_mini_title"><?= $not['title'] ?></h4>
                </a>
                <a href='<?= Url::to(['/']) . 'notes/view/' . $not['slug'] ?> '>
                    <img class="review_imgs"
                         src="<?= Url::to(['/']) . $not['img_url'] . $not['image'] ?>">
                </a>
            </div>
            <div class="review_hover">
                <button class="notes_btns note_cart btn btn-lightblue animate review_not"
                        data-url="<?= Url::to(['/']) . 'review/chus' ?>"
                        data-id="<?= $not['id'] ?>">Chuse
                </button>
            </div>
        </div>
            <?php } ?>

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="block-27">
                    <?php
                    echo \yii\widgets\LinkPager::widget(
                        [
                            'pagination' => $pagination,

                        ]);
                    ?>
                </div>
            </div>
        </div>
        <!--        --><?php //Pjax::end(); ?>
        <?php } else {
            ?>
            <div class="preview_title">
                <h2>
                    Համապատասխան նշումներ չկան !
                </h2>
            </div>
        <?php } ?>
    </div>
</div>