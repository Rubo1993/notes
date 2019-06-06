<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\SluggableBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $slug
 * @property integer $cv
 * @property integer $cv_url
 * @property integer $phone
 * @property integer $profession
 * @property string $auth_key
 * @property integer $status
 * @property integer $image
 * @property integer $user_img_url
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \lowbase\user\models\User
{

    public function rules()
    {
        $rules = parent::rules();

        return array_merge($rules, [
            [['profession', 'user_img_url', 'slug', 'cv_url'], 'string'],
            [['last_name', 'username'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 1, 'extensions' => 'png, jpg, gif,webp', 'maxSize' => 4 * 1024 * 1024, 'message' => 'ssssssssssssss'],
            [['cv'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt, doc, docx', 'maxFiles' => 1, 'maxSize' => 4 * 1024 * 1024],
        ]);
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'username',
                'slugAttribute' => 'slug',
                'ensureUnique' => true
            ],
        ];
    }

    public static function findByUsername($username)
    {

        return self::find()->where(['username' => $username])->one();
    }
}
