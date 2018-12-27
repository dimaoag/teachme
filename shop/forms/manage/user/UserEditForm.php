<?php
namespace shop\forms\manage\user;

use shop\entities\user\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserEditForm extends Model
{
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $role;

    public $_user;

    public function __construct(User $user, array $config = [])
    {
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;

        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['first_name', 'phone', 'role'], 'required'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
            [['email', 'phone'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

}