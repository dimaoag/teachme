<?php

namespace shop\services\manage;

use shop\entities\shop\TeacherMainInfo;
use shop\forms\manage\shop\TeacherMainInfoForm;
use shop\repositories\shop\TeacherMainInfoRepository;
use shop\repositories\shop\CityRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;
use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class TeacherMainInfoManageService
{
    private $repository;
    private $users;
    private $cities;
    private $transaction;


    public function __construct(
        UserRepository $users,
        TeacherMainInfoRepository $repository,
        CityRepository $cities,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->repository = $repository;
        $this->cities = $cities;
        $this->transaction = $transaction;
    }

    public function create(TeacherMainInfoForm $form): TeacherMainInfo
    {
        $city = $this->cities->get($form->city_id);


        $teacherMainInfo = TeacherMainInfo::create(
            Yii::$app->user->id,
            $city->id,
            $form->firm_name,
            $form->address,
            $form->phone_1,
            $form->phone_2,
            $form->instagram_link,
            $form->facebook_link,
            $form->vk_link,
            $form->youtube_link
        );

        if ($form->firm_photo) {
            $teacherMainInfo->addPhoto($form->firm_photo);
        }

        $this->repository->save($teacherMainInfo);
        return $teacherMainInfo;
    }


    public function edit($id, TeacherMainInfoForm $form): void
    {
        $teacherMainInfo = $this->repository->get($id);
        $city = $this->cities->get($form->city_id);

        $teacherMainInfo->edit(
            $city->id,
            $form->firm_name,
            $form->address,
            $form->phone_1,
            $form->phone_2,
            $form->instagram_link,
            $form->facebook_link,
            $form->vk_link,
            $form->youtube_link
        );

        if ($form->firm_photo) {
            $teacherMainInfo->addPhoto($form->firm_photo);
        }

        $this->repository->save($teacherMainInfo);

    }



    public function removePhoto($id): void
    {
        $teacherMainInfo = $this->repository->get($id);
        $teacherMainInfo->removePhoto($id);

    }


    public function remove($id): void
    {
        $teacherMainInfo = $this->repository->get($id);
        $this->repository->remove($teacherMainInfo);
    }
}