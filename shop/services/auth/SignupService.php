<?php
namespace shop\services\auth;

use shop\forms\auth\LoginForm;
use shop\forms\auth\SignupForm;
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


    public function signup(SignupForm $form)
    {
        $user = User::signupLeaner($form->first_name, $form->phone, $form->password, $form->password_confirm);
        Yii::$app->turbosms->send($user->password_confirm_code, $user->phone);
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