<?php
namespace shop\forms\auth;


use yii\base\Model;
use shop\entities\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $phone;


    public function rules()
    {
        return [
            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'replacePhone'],
            ['phone', 'exist',
                'targetClass' => User::className(),
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'По этому номеру телефона пользователь не найден.'
            ],
        ];
    }

    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }

}
