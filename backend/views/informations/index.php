<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Universities;
/* @var $this yii\web\View */
/* @var $searchModel common\models\InformationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Informations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'univer_id',
//            'faculty_id',


[
	'attribute' => 'faculty_id',
	'filter' => '',
	'value' => function($model){
		return \common\models\Universities::find()->one()->name;
	}
] ,

            'chair_id',
            'specializ_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
