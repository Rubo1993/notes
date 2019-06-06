<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="container">
    <div class="add-notes-page-title">
        <h1 class="sel_title">Ներբեռնեք ձեր նշումները</h1>
    </div>
    <div class="sell_flex">
        <div class="sell_left_part">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['/notes/update']),
                'method' => 'post'
            ]); ?>
            <?= $form->field($note, 'title')->textInput()->label('Վերնագիր') ?>
            <?= $form->field($note, 'univer_id')->dropDownList($univer, [
                'prompt' => 'Ընտրել...'])->label('Համալսարան') ?>
            <?= $form->field($note, 'language_id')->dropDownList($language, [
                'prompt' => 'Ընտրել...'])->label('Լեզու') ?>
            <?= $form->field($note, 'description')->textarea(['id' => 'not_edite_c'])->label('Նկարագրություն') ?>
            <?= $form->field($note, 'type_id')->dropDownList($type, [
                'prompt' => 'Ընտրել...'])->label('Փաստաթղթի տեսակը') ?>
            <div class="img_up">
                <div class="upImg">
                    <?= $form->field($note, 'image')->fileInput([
                        'class' => 'note_prew',
                        'id' => 'file1',
                        'style' => "display:none"
                    ])->label('Նախադիտման պատկերը') ?>
                    <div class="user_img_div">
                        <img src="<?= Url::to(['/']) . 'images/uploads/icons/eye_cropped1.png' ?>"
                             id="upfile1" style="cursor:pointer" class="not_img"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="sell_right_part">
            <?= $form->field($note, 'cat_id')->dropDownList($category, [
                'prompt' => 'Ընտրել...'])->label('Փաստաթղթի կատեգորիան') ?>
            <?= $form->field($note, 'price')->textInput(['type' => 'number'])->label('Գինը') ?>
            <?= $form->field($note, 'curency_id')->dropDownList($country, [
                'prompt' => 'Ընտրել...'])->label('Արժույթ') ?>
            <?= $form->field($note, 'length')->textInput(['type' => 'number'])->label('Երկարությունը') ?>
            <?= $form->field($note, 'year_authored')->dropDownList($year, [
                'prompt' => 'Ընտրել...'])->label('Գրվելու տարին') ?>
            <div class="upImg">
                <?= $form->field($note, 'notes')->fileInput([
                    'class' => 'userImg',
                    'id' => 'cv',
                    'style' => "display:none"
                ])->label('Ներբեռնեք ձեր նշումը') ?>
                <img src="<?= Url::to(['/']) . 'images/uploads/icons/download_note.png' ?>"
                     id="cv1" style="cursor:pointer" class="cv_img"/>
            </div>
            <input type="hidden" name="slug" value="<?= $note['slug'] ?>">
            <?= Html::submitButton('Հաստատել', [
                'class' => 'submitbt btn btn-primary',
                'name' => 'update_btn',
            ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
