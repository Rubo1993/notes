<?php
use yii\helpers\Url;
?>
<?php if (isset($user)){?>
<nav role="navigation">
	<div id="menuToggle">
		<input type="checkbox" />
		<span></span>
		<span></span>
		<span></span>
		<ul id="menu">
			<a class="res_menu_a" href="<?= Yii::$app->homeUrl?>"><li> <i class="fas fa-home"></i> Գլխավոր</li></a>
			<a class="res_menu_a" href="<?= Url::to( [ '/' ] ) . 'author/profile/' . $user['slug'] ?>"><li><i class="fa fa-sticky-note"></i> Իմ նշումները</li></a>
			<a class="res_menu_a" href="<?= Url::to( [ '/' ] ) . 'author/whishlist' ?>"><li><i class="far fa-heart"></i> Նախընտրելի</li></a>
			<a class="res_menu_a" href="<?= Url::to( [ '/' ] ) . 'author/downloaded' ?>"><li><li><i class="fas fa-download"></i>Ներբեռնումներ</li></a>

			<a class="res_menu_a" href="#"><li><li><i class="fa fa-credit-card"></i> Դրամապանակ</li></a>
            <a class="res_menu_a" href="<?= Url::to( [ '/' ] ) . 'notes/sell'?>"><li><li><i class="fa fa-upload"></i> Վերբեռնել նշում</li></a>
			<a class="res_menu_a" href="https://erikterwan.com/" target="_blank"><li>Show me more</li></a>
		</ul>
	</div>
</nav>
<?php }else{

}?>

<!--my_prof_hover-->
