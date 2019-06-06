<?php
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\slider\Slider;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="container need_container">
    <div class="search_nt">
        <div class="note_input_btn">
            <input value="<?= !empty($querys['not_search']) ? $querys['not_search'] : '' ?>" type="text"
                   name="not_search" placeholder="Որոնման նշումներ" form="searches_f">
            <input type="submit" class="submitbt btn btn-primary" value="Որոնել" form="searches_f">
        </div>
    </div>
    <div class="my_note_flex">
        <?php if(!empty($viewNot)){?>
        <div class="col-xs-3  col-md-3 filter_div panel">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['/notes/need']),
                'method' => 'get',
                'id' => 'searches_f']); ?>

            <?= Select2::widget([
                'name' => 'type_id',
                'value' => !empty($querys['type_id']) ? $querys['type_id'] : '',
                'data' => $data,
                'options' => ['multiple' => true, 'placeholder' => 'Ֆիլտրիր տիպով ...']
            ]);
            ?>

            <?= Select2::widget([
                'name' => 'language_id',
                'value' => !empty($querys['language_id']) ? $querys['language_id'] : '',
                'data' => $language,
                'options' => ['multiple' => true, 'placeholder' => 'Լեզու ...']
            ]);
            ?>
            <?= Select2::widget([
                'name' => 'univer_id',
                'value' => !empty($querys['univer_id']) ? $querys['univer_id'] : '',
                'data' => $univer,
                'options' => ['placeholder' => 'Համալսարան ...']
            ]);
            ?>
            <?= Select2::widget([
                'name' => 'country_id',
                'value' => !empty($querys['country_id']) ? $querys['country_id'] : '',
                'data' => $country,
                'options' => ['placeholder' => 'Երկիր ...']
            ]);
            ?>
            <?= Select2::widget([
                'name' => 'category_id',
                'value' => !empty($querys['category_id']) ? $querys['category_id'] : '',
                'data' => $category,
                'options' => ['placeholder' => 'Կատեգորիա ...']
            ]);
            ?>

            <?= Select2::widget([
                'name' => 'year_id',
                'value' => !empty($querys['year_id']) ? $querys['year_id'] : '',
                'data' => $year,
                'options' => ['placeholder' => 'Տարի ...']
            ]);
            ?>

            <div class="slide_inp">
                <label for="prices">Price</label><br>
                <?= "<b class='badge'>$" . $min_price . "</b>" . Slider::widget([
                    'name' => 'price',
                    'value' => (int)"$interval_start,$interval_end",
                    'sliderColor' => Slider::TYPE_GREY,
                    'pluginOptions' => [
                        'id' => 'prices',
                        'min' => (int)$min_price,
                        'max' => (int)$max_price,
                        'step' => 1,
                        'range' => true
                    ],
                ]) . " <b class='badge'>$" . $max_price . "</b>";
                ?>
            </div>
            <div class="slide_inp">
                <label for="length">length</label><br>
                <?= "<b class='badge'>" . $min_length . "</b>" . Slider::widget([
                    'name' => 'length',
                    'value' => (int)"$length_start,$length_end",
                    'sliderColor' => Slider::TYPE_GREY,
                    'pluginOptions' => [
                        'id' => 'length',
                        'min' => (int)$min_length,
                        'max' => (int)$max_length,
                        'step' => 1,
                        'range' => true
                    ],
                ]) . "<b class='badge'>" . $max_length . "</b>";

                ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <?php }?>
        <div class="col-xs-9 col-lg-offset-1   col-md-8 search_content  ">
            <div id="search-results-ajax">
                <div class="result_search_header">
                    <div class="results_heading">
                        Որոնման արդյունքները
                    </div>
                    <div class="result_qty">
                <span>
                     Գտնվել է <span class="res_qry"> <?= count($viewNot) ?></span>  նշում
                </span>
                    </div>
                </div>
            </div>
            <?php if (!empty($viewNot)){?>
                <?php Pjax::begin(); ?>

                <?php foreach ($viewNot as $notes) { ?>
                <div class="all_note_results">
                    <div class="need_not_it">
                        <a href='<?= Url::to(['/']) . 'notes/view/' . $notes['slug'] ?> '>
                            <div class="not_res_show">
                                <div class="document-header">
                                    <div class="document_title"><h5 class="title"><?= $notes['title'] ?></h5></div>
                                    <div class="document_price">
                                        <span><?= $notes['price'] . " " . $notes['sumbol'] ?></span>
                                    </div>
                                </div>

                            </div>
                            <div class="details">
                                <div class="excerpt">
                                    <p>
                                        <?= $notes['description'] ?>
                                    </p>
                                </div>
                                <div class="thumbnail">
                                    <?php if (!empty($notes['image'])) { ?>
                                        <img src="<?= Url::to(['/']) . $notes['img_url'] . $notes['image'] ?>">
                                    <?php } else { ?>
                                        <img src="<?= Url::to(['/']) . 'images/uploads/error_img/no_screen.png' ?>">
                                    <?php } ?>
                                    <div class="list_count"><?= $notes['length'] ?></div>
                                </div>
                            </div>
                        </a>
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
                <?php Pjax::end(); ?>
                <?php }?>

        </div>

    </div>

</div>


