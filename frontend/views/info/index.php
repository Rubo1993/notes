<?php
/* @var $form yii\bootstrap\ActiveForm */

/* @var $user \common\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<div class="user-settings-bgimg">
    <div class="user-settings-tab">
        <ul class="nav nav-tabs user-settings user_menu">
            <li class="user_btns">
                <a class="padding_none showSingle" target="1"><i class="fa fa-user"></i>ՊՐՈՖԻԼ
                </a>
            </li>
            <li class="user_btns">
                <a class="padding_none showSingle" target="2"><i class="fa fa-graduation-cap"></i>ԿՐԹՈՒԹՅՈՒՆ</a>
            </li>
            <li class="user_btns">
                <a class="padding_none showSingle" target="3"><i class="fa fa-random"></i>ՆԱԽԱՊԱՏՎՈՒԹՅՈՒՆ </a>
            </li>
        </ul>
    </div>

</div>
<div id="div1" class="targetDiv animated bounceln">

    <h1 class="form_title">Անձնական տվյալներ</h1>
    <div class="wrapper center" id="sec1">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => Url::to(['/info/index']),
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
<!--education-->
<div id="div2" class="targetDiv clone_edu" style="display: none">
    <div class="dublicate_edu" id="sec1">
        <h1 class="form_title">Կրթական տեղեկատվություն</h1>
        <div class="dublicate_f">
            <hr class="sep"/>
            <div class="btn-box">
                <h5>Համալսարաններ <span class="emoji">&#x1F609;</span></h5>
            </div>
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['/info/index']),
                'method' => 'post'
            ]); ?>
            <div class="all_date">
                <?= Html::submitButton('Հաստատել', [
                    'class' => 'submitbt btn btn-primary',
                    'id'=>'educat_save',

                ]) ?>
            </div>
            <div class="clone_this">
                <div class="clone_form cln">
                    <?php Pjax::begin(); ?>
                    <div class="edu_flex">
                        <div class="ed_fl">
                            <div class=" edu_select">
                                <?= $form->field($informations, 'univer_id')
                                    ->dropDownList($univer)->label('Համալսարան') ?>
                            </div>
                            <div class=" edu_select">
                                <?= $form->field($informations, 'faculty_id')
                                    ->dropDownList($faculty)->label('Ֆակուլտետ') ?>
                            </div>
                        </div>
                        <div class="ed_fl">
                            <div class=" edu_select">
                                <?= $form->field($informations, 'chair_id')
                                    ->dropDownList($chair)->label('Ամբիոն') ?>
                            </div>
                            <div class=" edu_select">
                                <?= $form->field($informations, 'specializ_id')
                                    ->dropDownList($specializ)->label('Մասնագիտություն') ?>
                            </div>
                        </div>
                    </div>
                    <?php Pjax::end(); ?>

                    <span id="remove" class="remove">Ջնջել</span>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="append_there"></div>
        <div class="add_sec">
            <span class="add">Աավելացնել</span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="line">
    <hr class="cls">
</div>
<!--preferences-->

<?php
\common\widgets\Alert::widget();
?>
<div id="div3" class="targetDiv prof_inf" style="display: none;">
    <div class="wrapper prof_inf_menu" id="sec1">
        <h1 class="form_title">Նախապատվություններ Տեղեկատվություն</h1>
        <div class="infoform">
            <div class="clearfix"></div>
            <div class="checks">
                <div class="category_check">
                    <?php if (!empty($preferenc)) { ?>
                        <?php foreach ($preferenc as $prefer) { ?>
                            <div class="preference_inp">
                                <input data-id="<?= $prefer['id'] ?>" name="sport" value="<?= $prefer['id'] ?>"
                                       id="<?= $prefer['id'] ?>_pr" type="checkbox" class="specializ_prof">
                                <label for="<?= $prefer['id'] ?>_pr"><?= $prefer['categories'] ?></label>
                            </div>
                        <? } ?>
                        <?php
                    }
                    ?>
                </div>
                <button id="specializ_submit_btn" type="button" class="submitbt btn btn-primary"
                        data-url="<?php echo Yii::$app->homeUrl . "info/preference" ?>">Հաստատել
                </button>
            </div>
        </div>
    </div>
</div>