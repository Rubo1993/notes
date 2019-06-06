<?php


namespace frontend\widgets\menyu;

use common\models\User;
use Yii;
class MenyuWidget extends  \yii\bootstrap\Widget
{
	public function run() {
		$id = Yii::$app->user->id;
		$user=User::find()->where( [ 'id' => $id ] )->asArray()->one();
		return $this->render( 'menyu', [
		'user'=>$user,
		] );
	}
}