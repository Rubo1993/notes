<?php
/* @var $form yii\bootstrap\ActiveForm */

/* @var $user \common\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div id="div1" class="targetDiv animated bounceln">
    <h1 class="form_title">Անձնական տվյալներ</h1>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <?= Yii::$app->session->getFlash('success') ?>
    <?php endif; ?>
    <div class="wrapper center user_inf_fields" id="sec1">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => Url::to(['/student/profile']),
            'method' => 'post'
        ]); ?>
        <hr class="sep"/>
        <div class="group">
            <?= $form->field($user, 'first_name')->textInput(['class' => 'info_myForm bar'])->label('Անուն') ?>

        </div>
        <div class="group ">
            <?= $form->field($user, 'last_name')->textInput(['class' => 'info_myForm bar'])->label('Ազգանուն') ?>
        </div>
        <div class="group">
            <?= $form->field($user, 'username')->textInput(['class' => 'info_myForm bar'])->label('Օգտանուն') ?>
        </div>
        <div class="group">
            <div class="input-group mb-2 mr-sm-2 mb-sm-0 curency_in">
                <div class="curenc_bg input-group-addon currency-symbol">$</div>
                <div class="curenc_bg input-group-addon currency-addon">
                    <?= $form->field($user, 'currency')->dropDownList($currency, [
                        'prompt' => 'Ընտրել...',
                        'class' => 'currency-selector',
                    ])->label('Արժույթ', ['class' => 'curenc_lab']) ?>
                </div>
            </div>
        </div>
        <div class="group">
            <div class="img_up">
                <div class="upImg">
                    <?= $form->field($user, 'image')->fileInput([
                        'class' => 'userImg',
                        'id' => 'file1',
                        'style' => "display:none"
                    ])->label('Ընտրեք նկար') ?>
                    <div class="user_img_div">
                        <img src="<?= Url::to(['/']) . 'images/uploads/all/male.png' ?>"
                             id="upfile1" style="cursor:pointer"/>
                    </div>
                </div>
            </div>
        </div>
        <!--        cv-->
        <div class="group">
            <div class="img_up">
                <div class="upImg">
                    <?= $form->field($user, 'cv')->fileInput([
                        'class' => 'userImg',
                        'id' => 'cv',
                        'style' => "display:none"
                    ])->label('CV') ?>
                    <img src="<?= Url::to(['/']) . 'images/uploads/all/cv-upload.jpg' ?>"
                         id="cv1" style="cursor:pointer" class="cv_img"/>
                </div>
            </div>
        </div>
        <!--        cv end-->
        <div class="btn-box">
            <?= Html::submitButton('Հաստատել', [
                'class' => 'submitbt btn btn-primary',
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
<div class="line">
    <hr class="cls">
</div>
<!--preferences-->
<?php
\common\widgets\Alert::widget();
?>
