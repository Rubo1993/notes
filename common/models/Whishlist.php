<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "whishlist".
 *
 * @property int $id
 * @property int $whish_user_id
 * @property int $whish_note_id
 * @property string $wish_add_date
 */
class Whishlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'whishlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['whish_user_id', 'whish_note_id'], 'integer'],
            [['wish_add_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'whish_user_id' => 'Whish User ID',
            'whish_note_id' => 'Whish Note ID',
            'wish_add_date' => 'Wish Add Date',
        ];
    }
}
