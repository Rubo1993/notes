<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Informations */

$this->title = 'Create Informations';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
