<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lb_country".
 *
 * @property int $id
 * @property string $name
 * @property string $currency
 * @property string $currency_code
 * @property string $sumbol
 *
 * @property LbCity[] $lbCities
 * @property LbUser[] $lbUsers
 */
class LbCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lb_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'currency', 'sumbol'], 'string', 'max' => 255],
            [['currency_code'], 'string', 'max' => 5],
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
            'currency' => 'Currency',
            'currency_code' => 'Currency Code',
            'sumbol' => 'Sumbol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLbCities()
    {
        return $this->hasMany(LbCity::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLbUsers()
    {
        return $this->hasMany(LbUser::className(), ['country_id' => 'id']);
    }
}
