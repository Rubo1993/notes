<?php

use yii\helpers\Url;
?>
<div class="container">
    <div class="statistic_fl">
        <div class="author_notes downloaded_nt_list">
            <div class="results_current_nt">
                Բեռնվել է <span class="bold"><?= count($downloaded) ?></span> նշում։
            </div>
            <?php if (!empty($downloaded)) { ?>
                <?php foreach ($downloaded as $nt) { ?>
                    <div class="author_not_item ">
                        <a class="   scren_img_desc" href="<?= Url::to(['/']) . 'notes/view/' . $nt['slug'] ?>">
                            <div class="nots_flx ">
                                <div class="download_nt">
                                    <div class="nts_imgs">
                                        <img src="<?= Url::to(['/']) . $nt['img_url'] . $nt['image'] ?>" alt="">
                                    </div>
                                    <div class="nts_cont downloaded_title">
                                        <span class="author_not_title"><?= $nt['title'] ?></span>
                                        <p class="nt_conten_t">
                                            <?= $nt['description'] ?>
                                        </p>
                                    </div>
                                </div>
                                <!--                            <div class="price_dwn">-->
                                <div class="downloaded_cont">
                                    <div class="date_down"><?= $nt['date'] ?></div>
                                    <div>
                                        <a href="<?= Url::to(['/']) . 'notes/download/' . $nt['slug'] ?>">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <? } ?>
                <?php
            }
           ?>
        </div>
</div>
