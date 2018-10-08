<?php
namespace shop\forms\auth;

use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $code;
    public $password;
    public $password_confirm;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['code', 'trim'],
            ['code', 'required'],
            ['code', 'integer'],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_confirm', 'trim'],
            ['password_confirm', 'required'],
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают." ],
            ['password_confirm', 'string', 'min' => 6],
        ];
    }

}
