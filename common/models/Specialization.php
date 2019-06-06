<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property int $chair_id
 * @property string $name
 *
 * @property Chair $chair
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chair_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['chair_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chair::className(), 'targetAttribute' => ['chair_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chair_id' => 'Chair ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChair()
    {
        return $this->hasOne(Chair::className(), ['id' => 'chair_id']);
    }
}
