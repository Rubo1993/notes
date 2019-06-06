<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $firstname;
    public $lastname;
    public $username;
	public $password_hash;
//	public $password;
//	public $password_reset_token;

	public $email;
	public $phone;
	public $profession;
	public $verify;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
	        ['firstname', 'trim'],
	        ['firstname', 'required'],
	        ['lastname', 'trim'],
	        ['lastname', 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
	        ['phone','trim'],
	        ['phone','required'],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => 6],
//	        ['password_reset_token', 'required'],
//	        ['password_reset_token', 'string', 'min' => 6],
	        ['verify','trim'],
//	        ['profession','required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
	    if (!$this->validate()) {
            return null;
        }
//        var_dump($this);
        $user = new User();
	    $user->first_name = $this->firstname;
	    $user->last_name = $this->lastname;
//	    $user->password_hash = $this->password_hash;
//	    $user->password_reset_token = $this->password_reset_token;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
	    $user->profession = '0';
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}




