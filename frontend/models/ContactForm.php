<?php

namespace frontend\models;

use app\models\Messages;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $email;
    public $profesor_id;
    public $student_id;
    public $prof_name;
    public $tel_number;
    public $message;
    public $date;
    public $name;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $profesor_id = Yii::$app->user->id;
        $user= User::find()->where(['id'=>$profesor_id])
            ->asArray()->one();
        $model = new Messages();
        $model->email = $this->email;
        $model->profesor_id = $profesor_id;
        $model->student_id = $profesor_id;
        $model->tel_number = $this->tel_number;
        $model->message = $this->message;
        $model->name = $this->name;
        $model->save(false);
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $user['email']])
            ->setSubject($this->subject)
            ->setTextBody($this->message)
            ->send();
    }
}
