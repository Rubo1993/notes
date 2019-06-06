<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property int $id
 * @property int $univer_id
 * @property string $name
 *
 * @property Chair[] $chairs
 * @property Universities $univer
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['univer_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['univer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universities::className(), 'targetAttribute' => ['univer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'univer_id' => 'Univer ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChairs()
    {
        return $this->hasMany(Chair::className(), ['faculty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniver()
    {
        return $this->hasOne(Universities::className(), ['id' => 'univer_id']);
    }
}
