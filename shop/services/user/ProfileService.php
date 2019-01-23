<?php

namespace shop\services\user;

use shop\forms\manage\user\ProfileEditForm;
use shop\forms\manage\user\ProfileEditPasswordForm;
use shop\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function edit($id, ProfileEditForm $form): void
    {
        $user = $this->users->getUserById($id);
        $user->editProfile($form->first_name, $form->last_name, $form->email, $form->phone);
        $this->users->save($user);
    }

    public function changePassword($id, ProfileEditPasswordForm $form){
        $user = $this->users->getUserById($id);
        $user->changePassword($form->password1);
        $this->users->save($user);

    }
}