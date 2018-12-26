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


    public function minusPublication($id, $courseTypeId): void
    {
        $user = $this->repository->getUserById($id);
        if (!empty($user->getPublication($courseTypeId))){
            $user->deletePublication($courseTypeId);
        }

        $this->repository->save($user);
    }

    public function plusPublication($userId, $courseTypeId ): void
    {
        $user = $this->repository->getUserById($userId);
        $user->setPublication($courseTypeId, 1);
        $this->repository->save($user);
    }



}