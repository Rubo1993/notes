<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "preferences".
 *
 * @property int $id
 * @property int $user_id
 * @property string $preference_name
 * @property string $cats_img
 */
class Preferences extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preferences';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['preference_name', 'cats_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'preference_name' => 'Preference Name',
            'cats_img' => 'Cats Img',
        ];
    }
}
