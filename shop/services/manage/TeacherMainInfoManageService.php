<?php

namespace shop\services\manage;

use shop\entities\shop\TeacherMainInfo;
use shop\forms\manage\shop\TeacherMainInfoForm;
use shop\forms\manage\shop\TeacherMainInfoPhotoForm;
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


        foreach ($form->photo->files as $file) {
            $teacherMainInfo->addPhoto($file);
        }


        $this->transaction->wrap(function () use ($teacherMainInfo, $form) {
            $this->repository->save($teacherMainInfo);
        });
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

        $this->repository->save($teacherMainInfo);

    }


    public function addPhotos($id, TeacherMainInfoPhotoForm $form): void
    {
        $teacherMainInfo = $this->repository->get($id);
        foreach ($form->files as $file) {
            $teacherMainInfo->addPhoto($file);
        }
        $this->repository->save($teacherMainInfo);
    }


    public function removePhoto($id, $photoId): void
    {
        $teacherMainInfo = $this->repository->get($id);
        $teacherMainInfo->removePhoto($photoId);
        $this->repository->save($teacherMainInfo);
    }


    public function remove($id): void
    {
        $teacherMainInfo = $this->repository->get($id);
        $this->repository->remove($teacherMainInfo);
    }
}