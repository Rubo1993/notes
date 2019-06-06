<?php

namespace frontend\widgets\professor;
use common\models\Cart;
use common\models\User;
use Yii;
class ProfessorWidget extends \yii\bootstrap\Widget
{
    public function run() {

        $id = Yii::$app->user->id;
        $profesor=User::find()->where( [ 'id' => $id ] )
            ->andWhere(['profession'=>'1'])
            ->asArray()->one();
        $student=User::find()->where( [ 'id' => $id ] )
            ->andWhere(['profession'=>'0'])
            ->asArray()->one();
        $username= User::findOne([$id]);
        $cart = Cart::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $count = count($cart);
        return $this->render( 'professor', [
            'username'=>$username,
            'count'=>$count,
            'profesor'=> $profesor,
            'student'=>$student
        ] );
    }
}