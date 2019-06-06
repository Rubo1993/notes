<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Universities */

$this->title = 'Create Universities';
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="universities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
