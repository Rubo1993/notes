ук<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Chair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faculty_id')->dropDownList($chair,['prompt'=>'Ընտրեք Ֆակուլտետը']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
