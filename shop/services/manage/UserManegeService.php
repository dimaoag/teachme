<?php
namespace shop\services\manage;

use shop\entities\user\User;
use shop\repositories\UserRepository;
use shop\forms\manage\user\UserEditForm;

class UserManegeService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }



    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->getUserById($id);
        $user->edit(
            $form->first_name,
            $form->last_name,
            $form->email,
            $form->phone
        );
        $this->repository->save($user);
    }





}