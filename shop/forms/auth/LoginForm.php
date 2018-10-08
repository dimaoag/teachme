<?php
namespace shop\forms\auth;


use yii\base\Model;


class LoginForm extends Model
{
    public $phone;
    public $password;
    public $rememberMe = true;


    public function rules()
    {
        return [
            // username and password are both required
            ['phone', 'replacePhone'],
            ['phone', 'trim'],
            ['phone', 'required'],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
}
