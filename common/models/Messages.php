<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $email
 * @property int $profesor_id
 * @property int $student_id
 * @property string $prof_name
 * @property string $tel_number
 * @property string $message
 * @property string $date
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profesor_id', 'student_id'], 'integer'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['email', 'prof_name', 'tel_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'profesor_id' => 'Profesor ID',
            'student_id' => 'Student ID',
            'prof_name' => 'Prof Name',
            'tel_number' => 'Tel Number',
            'message' => 'Message',
            'date' => 'Date',
        ];
    }
}
