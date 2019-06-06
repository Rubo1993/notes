<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "universities".
 *
 * @property int $id
 * @property string $name
 *
 * @property Faculty[] $faculties
 */
class Universities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'universities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculties()
    {
        return $this->hasMany(Faculty::className(), ['univer_id' => 'id']);
    }
}
