<?php
namespace shop\services\auth;

use shop\access\Rbac;
use shop\forms\auth\SignupLearnerForm;
use shop\entities\user\User;
use shop\forms\auth\SignupTeacherForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;

class SignupService{

    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }


    public function signupLearner(SignupLearnerForm $form)
    {
        $user = User::signupLeaner($form->first_name, $form->phone, $form->password);
        $user->sendSms();
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
    }

    public function signupTeacher(SignupTeacherForm $form)
    {
        $user = User::signupTeacher($form->first_name, $form->last_name, $form->phone, $form->email, $form->password);
        $user->sendSms();
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
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