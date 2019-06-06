<?php
namespace frontend\widgets\review;

use common\models\Note;

class ReviewWidget extends \yii\bootstrap\Widget{
public function run() {
	$notes= Note::find()->asArray()->all();
	return $this->render('review',[
		'notes'=>$notes,
	]);
}
}