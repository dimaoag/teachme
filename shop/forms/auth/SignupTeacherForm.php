<?php
namespace shop\forms\auth;

use yii\base\Model;

/**
 * SignupTeacher form
 */
class SignupTeacherForm extends Model
{
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
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

            ['last_name', 'trim'],
            ['last_name', 'string', 'min' => 2, 'max' => 50],

            ['phone', 'replacePhone'],
            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string'],
            ['phone', 'unique', 'targetClass' => '\shop\entities\User', 'message' => 'Этот телефон уже существует в базе.'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\shop\entities\User', 'message' => 'Этот email уже существует в базе.'],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_confirm', 'trim'],
            ['password_confirm', 'required'],
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают." ],
            ['password_confirm', 'string', 'min' => 6],
        ];
    }



    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }



    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_confirm' => 'Подтвердить пароль',
        ];
    }


}
