<?php

namespace shop\forms\manage\user;

use shop\entities\user\User;
use yii\base\Model;

class ProfileEditForm  extends Model
{

    public $first_name;
    public $last_name;
    public $phone;
    public $email;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->_user = $user;
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['phone', 'email', 'first_name'], 'required'],

            ['phone', 'replacePhone'],
            ['phone', 'trim'],
            ['phone', 'string'],

            ['email', 'email'],

            [['email', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['phone', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }


    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }



}