<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="privew_container">
	<?php if (!empty($viewNot)){
		?>
		<div class="preview_title">
			<h2>
				Նոթերի Վերանայում
			</h2>
		</div>
        <?php Pjax::begin(); ?>
		<div class="note_review_imtes">
			<?php foreach($viewNot as $not){
				?>
				<div class="review_item" id="">
					<div class="review_blog">
						<a href='<?= Url::to( [ '/' ] ) . 'notes/view/' . $not['slug'] ?> '>
							<h4 class="review_mini_title"><?= $not['title']?></h4>
							<img class="review_imgs" src="<?= Url::to( [ '/' ] ) . $not['img_url'] . $not['image'] ?>">
						</a>
					</div>
					<div class="review_hover">
                        <a href="<?=Url::to( [ '/' ] ) . 'review/edit/' . $not['slug'] ?>" class="note_cart btn btn-lightblue " >
                            Edit</a>
					</div>
				</div>
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
        <?php Pjax::end(); ?>
	<?php     }else{
		?>
		<div class="preview_title">
			<h2>
				Դուք չունեք ակտիվ նշումներ
			</h2>
		</div>
	<?php }?>



</div>