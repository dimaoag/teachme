<?php
namespace shop\forms\auth;

use yii\base\Model;
use frontend\components\Debug;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $phone;
    public $password;
    public $password_confirm;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string', 'min' => 2, 'max' => 50],

            ['phone', 'replacePhone'],
            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 13],
//            ['email', 'unique', 'targetClass' => '\shop\entities\User', 'message' => 'This email address has already been taken.'],
            ['phone', 'unique', 'targetClass' => '\shop\entities\User', 'message' => 'Этот телефон уже существует в базе.'],


            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],


            ['password_confirm', 'trim'],
            ['password_confirm', 'required'],
            ['password_confirm', 'passwordCompare'],
            ['password_confirm', 'string', 'min' => 6],
        ];
    }



    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }



    public function passwordCompare()
    {
        if ($this->password != $this->password_confirm){
            $this->addError('password_confirm', 'Пароли не совпадают.');
            return false;
        }
        return true;
    }


    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'password_confirm' => 'Подтвердить пароль',
        ];
    }


}
