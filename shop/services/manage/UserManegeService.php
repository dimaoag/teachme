<?php
namespace shop\services\manage;

use shop\entities\shop\CourseType;
use shop\entities\user\Payment;
use shop\entities\user\User;
use shop\forms\manage\user\PaymentForm;
use shop\forms\manage\user\PublicationChangeForm;
use shop\repositories\UserRepository;
use shop\forms\manage\user\UserEditForm;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use shop\repositories\shop\CourseTypeRepository;
use shop\forms\manage\user\UserCreateForm;


class UserManegeService
{
    private $repository;
    private $roles;
    private $courseTypeRepository;
    private $transaction;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles,
        CourseTypeRepository $courseTypeRepository,
        TransactionManager $transaction
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->courseTypeRepository = $courseTypeRepository;
        $this->transaction = $transaction;
    }


    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->first_name,
            $form->last_name,
            $form->phone,
            $form->email,
            $form->designation,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
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
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }


    public function assignRole($id, $role): void
    {
        $user = $this->repository->getUserById($id);
        $this->roles->assign($user->id, $role);
    }

    public function minusPublication($id, $courseTypeId): void
    {
        $user = $this->repository->getUserById($id);
        if (!empty($user->getPublication($courseTypeId))){
            $user->deletePublication($courseTypeId);
        }

        $this->repository->save($user);
    }

    public function returnOnePublication($userId, $courseTypeId)
    {
        $user = $this->repository->getUserById($userId);
        $user->setPublication($courseTypeId, 1);
        $this->repository->save($user);
    }

    public function plusPublication(Payment $payment): void
    {
        $user = $this->repository->getUserById($payment->user_id);
        $courseType = $this->courseTypeRepository->get($payment->course_type_id);
        if ($payment->status === Payment::COMPLETED){
            $user->setPublication($courseType->id, $payment->quantity);
            $this->repository->save($user);
        }
    }


    public function setPublicationToUser($userId, $quantity)
    {
        $user = $this->repository->getUserById($userId);
        $courseTypes = $this->courseTypeRepository->getAll();
        foreach ($courseTypes as $courseType){
            /**@var $courseType CourseType  */
            $user->setPublication($courseType->id, $quantity);

        }
        $this->repository->save($user);
    }


    public function changePublication(PublicationChangeForm $form): void
    {
        $user = $this->repository->getUserById($form->userId);
        $courseType = $this->courseTypeRepository->get($form->courseTypeId);
        $user->changePublication($courseType->id, $form->quantity);
        $this->repository->save($user);

    }


}