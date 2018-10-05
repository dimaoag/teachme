<?php
namespace shop\forms\auth;

use yii\base\Model;


class ConfirmPasswordForm extends Model
{

    public $confirm_code;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['confirm_code', 'trim'],
            ['confirm_code', 'required'],
            ['confirm_code', 'integer'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'confirm_code' => 'Код подтверждения телефона',
        ];
    }


}
