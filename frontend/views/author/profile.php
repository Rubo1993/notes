<?php

use yii\helpers\Url;
?>
<div class="container">
    <div class="profile_fl">
        <div class="profile_img">
            <img src="<?= Url::to(['/']) . $author['user_img_url'] . $author['image'] ?>"
                 alt="profile img">
        </div>
        <div class="profile_info">
            <p>Անուն։<span class="bold"> <?= $author['first_name'] ?></span></p>
            <p>Ազգանուն։<span class="bold"> <?= $author['last_name'] ?></span></p>
        </div>
    </div>
    <div class="statistic_fl">
        <div class="author_notes">
            <div class="results_current_nt">
                Գտնվել է <span class="bold"><?= count($all_notes) ?></span> նշում։
            </div>
            <?php if (!empty($all_notes)){?>
            <?php foreach ($all_notes as $nt) { ?>
                <div class="author_not_item ">
                    <a class="links_css not_tit_cont my_not_respons" href="<?= Url::to(['/']) . 'notes/view/' . $nt['slug'] ?>">
                        <div class="nots_flx  overfl_hid">
                            <div class="nts_imgs">
                                <img src="<?= Url::to(['/']) . $nt['img_url'] . $nt['image'] ?>" alt="">
                            </div>
                            <div class="nts_cont">
                                <span class="author_not_title"><?= $nt['title'] ?></span>
                                <p class="nt_conten_t">
                                    <?= $nt['description'] ?>
                                </p>
                            </div>
                            <div class="price_dwn">
                                <div class="price_inf">
                    <span>
                        <?= $nt['price'] . ' ' . $nt['sumbol'] ?>
                    </span>
                                </div>
                                <div class="edit_btn">
                                    <?php if ($update_btn) {
                                        ?>
                                        <a class="price_in" href="<?= Url::to(['/notes/update/' . $nt['slug']]) ?>">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <? } ?>
            <?php }?>
        </div>
        <div class="statistic_d">
            <div class="statistic_cn">
                <div class="stat_log">
                    <img src="" alt="">
                </div>
                <div class="">
                    <div class="stat_inf_res">
                        <div class="info_icon_cont">
                            <div>
                                <i class="fas fa-chart-pie" style="font-size:25px; color:#0b97c4"></i>
                            </div>
                            <div>
                                <span class="author_not_title">Statistics</span>
                            </div>
                        </div>
                    </div>
                    <div class="stat_inf_res">
                        <div class="info_icon_cont">
                            <div>
                                <i class="fas fa-arrow-alt-circle-down" style="font-size:25px; color:#0b97c4"></i>
                            </div>
                            <div>
                                <span class="author_not_title">Sales</span>
                            </div>

                        </div>
                        <div>
                                <span class="last_downloads">
                                    <?php echo $sum ?>
                                </span>
                        </div>
                    </div>
                    <div class="stat_inf_res">
                        <div class="info_icon_cont">
                            <div>
                                <i class="far fa-clock" style="font-size:25px; color:#0b97c4"></i>
                            </div>
                            <div>
                                <span class="author_not_title">Last Item Sold</span>
                            </div>
                        </div>
                        <div>
                            <span class="last_downloads">2 weeks ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
