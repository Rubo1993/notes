<?php
use yii\helpers\Url;

?>
<div class="container padding_tops ">
	<h2 class="whish_item_title">
		Նախընտրելի  նշումներ (<?= $count?>)
	</h2>
    <div class="wishlist_fl">
        <?php if (!empty($wishView)){?>
        <?php foreach ($wishView as $whish){?>
        <div class="whis_item">
            <a href="<?= Url::to( [ '/' ] ) . 'notes/view/' . $whish['slug'] ?>">
            <img src="<?= Url::to( [ '/' ] ) . $whish['img_url'] . $whish['image'] ?>" class="whishlists_img_it" alt="whish_img">
            </a>
            <div class="review_hover hover_bg">
                <a class="whish_hover_inf" href="<?= Url::to([ '/' ]).'notes/view/'.$whish['slug']?>">
                    <?=$whish['title'] ?>
                </a>
            </div>
        </div>
        <?}?>
        <?php }?>
    </div>
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
</div>