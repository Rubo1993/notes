<?php
namespace frontend\widgets\profile;

use common\models\User;
use Yii;
class profileWidget extends \yii\bootstrap\Widget
{
    public function run()
    {
        $id = Yii::$app->user->id;
        $student=User::find()->where( [ 'id' => $id ] )
            ->andWhere(['profession'=>'0'])
            ->asArray()->one();
        return $this->render( 'profile', [
            'student'=> $student,
        ] );
    }

}