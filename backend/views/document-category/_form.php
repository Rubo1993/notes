<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cat_imgs')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
