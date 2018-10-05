<?php
namespace shop\services\auth;

use shop\forms\auth\LoginForm;
use shop\forms\auth\SignupLearner;
use shop\entities\User;
//use yii\mail\MailerInterface;
use shop\repositories\UserRepository;
use frontend\components\Debug;
use Yii;
use avator\turbosms\Turbosms;
use yii\helpers\Url;

class SignupService{

//    private $mailer;
    private $users;

    public function __construct(UserRepository $users)
    {
//        $this->mailer = $mailer;
        $this->users = $users;
    }


    public function signupLearner(SignupLearner $form)
    {
        $user = User::signupLeaner($form->first_name, $form->phone, $form->password, $form->password_confirm);
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