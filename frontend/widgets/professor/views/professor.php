<?php

use yii\helpers\Url;

?>
<ul class="navbar-nav navbar-right margin_no nav custom__nav">
    <?php
    if (isset($profesor)) {
        ?>
        <li>
            <a href="<?= Url::to(['/']) . 'review/check' ?>">Ստուգման մեջ</a>
        </li>
        <li>
            <a href="<?= Url::to(['/']) . 'review/notes' ?>">Վերանայում</a>
        </li>
        <?
    }
    ?>
    <li>
        <a href="<?= Url::to(['/']) . 'notes/need' ?>">Գնել նշում</a>
    </li>
    <li>
        <a href="<?= Url::to(['/']) . 'notes/sell' ?>">Վաճառել նշում</a>
    </li>
    <li>
        <a href="<?= Url::to(['/']) . 'author/cart' ?>" class="title ">
            <i class="fa fa-shopping-cart"></i> <sup class="cart-quantity">
                <?= $count ?></sup>
        </a>
    </li>
    <li class="my_prof_hov">
        <a href="<?= Url::to(['/']).'info/index' ?>">
            <img class="prof_hv" src="<?= Url::to(['/']) . 'images/uploads/icons/administrator-male.png' ?>" alt="">
        </a>
        <div class="logout_hov ">
            <div>
                <?php if ($username['profession'] == 0) { ?>
                    <a href="<?= Url::to(['/']) . 'student/profile' ?>">Իմ էջ</a>
                <?php }else{?>
                    <a href="<?= Url::to(['/']) . 'info/index' ?>">Իմ էջ</a>
                <?php }?>
            </div>
            <div>
                <a href="<?= Url::to(['/site/logout']) ?>">Logout (<?= $username['username'] ?>)</a>
            </div>

        </div>
    </li>
</ul>
