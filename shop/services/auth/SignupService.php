<?php
namespace shop\services\auth;

use shop\forms\auth\LoginForm;
use shop\forms\auth\SignupLearnerForm;
use shop\entities\user\User;
use shop\forms\auth\SignupTeacherForm;
use shop\repositories\UserRepository;
use frontend\components\Debug;
use Yii;
use avator\turbosms\Turbosms;
use yii\helpers\Url;

class SignupService{

    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }


    public function signupLearner(SignupLearnerForm $form)
    {
        $user = User::signupLeaner($form->first_name, $form->phone, $form->password);
        $user->sendSms();
        $this->users->save($user);
    }

    public function signupTeacher(SignupTeacherForm $form)
    {
        $user = User::signupTeacher($form->first_name, $form->last_name, $form->phone, $form->email, $form->password);
        $user->sendSms();
        $this->users->save($user);
    }



    public function confirm($code)
    {
        if (empty($code)){
            throw new \DomainException('Код не введен');
        }
        $user = $this->users->getUserByConfirmCode($code);
        $user->confirmSignup();
        $this->users->save($user);
        return $user;
    }


}