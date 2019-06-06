<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review_note".
 *
 * @property int $id
 * @property int $user_id
 * @property int $note_id
 * @property string $chuse_date
 */
class ReviewNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'note_id'], 'integer'],
            [['chuse_date'], 'safe'],
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
            'note_id' => 'Note ID',
            'chuse_date' => 'Chuse Date',
        ];
    }
}
