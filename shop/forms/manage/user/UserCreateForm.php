<?php
namespace shop\forms\manage\user;

use shop\entities\user\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $designation;
    public $password;
    public $role;

    public function rules()
    {
        return [
            [['first_name', 'phone', 'role', 'designation', 'password'], 'required'],
            ['phone', 'replacePhone'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 255, 'min' => 6],
            [['phone', 'email'], 'unique', 'targetClass' => User::class],
            ['email', 'email'],
        ];
    }

    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function designationList(): array
    {
        return [
            User::LEARNER => 'Пользователь',
            User::TEACHER => 'Школа',
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'designation' => 'Обозначение',
            'role' => 'Роль',
        ];
    }

}