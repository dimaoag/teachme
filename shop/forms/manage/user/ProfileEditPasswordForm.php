<?php

namespace shop\forms\manage\user;

use shop\entities\user\User;
use Yii;
use yii\base\Model;

class ProfileEditPasswordForm  extends Model
{
    public $oldPassword;
    public $password1;
    public $password2;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['password2', 'password1', 'oldPassword'], 'required'] ,
            [['password2', 'password1', 'oldPassword'], 'trim'] ,
            [['password2', 'password1', 'oldPassword'], 'string', 'min' => 6],
            ['oldPassword', function ($attribute, $params) {
                if (!$this->_user->validatePassword($this->$attribute)) {
                    $this->addError($attribute, 'Неверный пароль');
                    Yii::$app->session->setFlash('error', 'Неверный пароль');
                }
            }],
            ['password2', 'compare', 'compareAttribute'=>'password1', 'message'=>"Пароли не совпадают." ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Старый пароль',
            'password1' => 'Новый пароль',
            'password2' => 'Подтвердить пароль',
        ];
    }








}