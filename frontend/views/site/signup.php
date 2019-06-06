<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Գրանցվել';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <article class="info_articl">
        <h1><?= Html::encode($this->title) ?></h1>

        <p class="regist_inf">Գրանցվելու համար խնդրում ենք լրացնել հետեւյալ դաշտերը *</p>
    </article>
    <div class="registr_fl">
        <div class="signup-img">
            <img class="sign_img" src="<?= \yii\helpers\Url::to(['/']) . 'images/uploads/all/register_background.jpg' ?>">
        </div>
        <div class="rg_colums">
            <div class="row">
                <div class="col-lg-7">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <?= $form->field($model, 'firstname') ?>
                    <?= $form->field($model, 'lastname') ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password_hash')->passwordInput() ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'verify')->dropDownList(['Ընտրել', 'Ուսանող', 'Պրոֆեսոր'])->label('Profession') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Գրանցվել', ['class' => 'submitbt btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
