<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "informations".
 *
 * @property int $id
 * @property int $user_id
 * @property int $univer_id
 * @property int $faculty_id
 * @property int $chair_id
 * @property int $specializ_id
 * @property string $preferenc_id
 *
 * @property LbUser $user
 * @property Universities $univer
 */
class Informations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['preferenc_id', 'univer_id', 'faculty_id', 'chair_id', 'specializ_id'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'univer_id' => 'Univer ID',
            'faculty_id' => 'Faculty ID',
            'chair_id' => 'Chair ID',
            'specializ_id' => 'Specializ ID',
            'preferenc_id' => 'Preferenc ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(LbUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniver()
    {
        return $this->hasOne(Universities::className(), ['id' => 'univer_id']);
    }
}
