<?php
namespace shop\services\auth;

use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\repositories\UserRepository;

class PasswordResetService
{
    private $users;


    public function __construct(UserRepository $users)
    {
           $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form)
    {
        $user = $this->users->getUserByPhone($form->phone);
        if (!$user->isActive()){
            throw new \DomainException('Пользователь не активиный');
        }

        $user->requestPasswordReset();
        $this->users->save($user);
    }


    public function validateCode($code)
    {
        if (empty($code) || !is_numeric($code)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existByPasswordResetCode($code)) {
            throw new \DomainException('Неправильный код');
        }
    }


    public function reset($code, ResetPasswordForm $form)
    {
        $user = $this->users->getUserByPasswordResetCode($code);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }



}