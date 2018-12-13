<?php

namespace shop\services\manage;

use shop\entities\shop\course\Course;
use shop\forms\manage\shop\course\CategoriesForm;
use shop\entities\shop\course\Error;
use shop\forms\manage\shop\course\ErrorForm;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\repositories\shop\CityRepository;
use shop\repositories\shop\CategoryRepository;
use shop\repositories\shop\CourseRepository;
use shop\repositories\shop\ErrorRepository;
use shop\repositories\shop\TeacherMainInfoRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;
use shop\services\search\CourseIndexer;
use Yii;
use yii\helpers\VarDumper;

class CourseManageService
{
    private $users;
    private $courses;
    private $cities;
    private $errors;
    private $categories;
    private $indexer;
    private $teachersMainInfo;
    private $transaction;

    public function __construct(
        UserRepository $users,
        CourseRepository $courses,
        CityRepository $cities,
        ErrorRepository $errors,
        CategoryRepository $categories,
        CourseIndexer $indexer,
        TeacherMainInfoRepository $teachersMainInfo,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->courses = $courses;
        $this->cities = $cities;
        $this->errors = $errors;
        $this->categories = $categories;
        $this->indexer = $indexer;
        $this->teachersMainInfo = $teachersMainInfo;
        $this->transaction = $transaction;
    }

    public function create(CourseCreateForm $form): Course
    {
        $city = $this->cities->get($form->cityId);
        $category = $this->categories->get($form->categories->main);
        $teacherMainInfo = $this->teachersMainInfo->get($form->firmId);

        $course = Course::create(
            Yii::$app->user->id,
            $city->id,
            $category->id,
            $teacherMainInfo->id,
            $form->name,
            $form->price,
            $form->description
        );


        foreach ($form->values as $value) {
            $course->setValue($value->id, $value->value);
        }

        foreach ($form->photos->files as $file) {
            $course->addPhoto($file);
        }

        foreach ($form->gallery->gallery as $galleryImage) {
            $course->addGalleryImage($galleryImage);
        }


        $this->transaction->wrap(function () use ($course, $form) {
            $this->courses->save($course);
        });
        return $course;
    }

    public function edit($id, CourseEditForm $form): void
    {
        $course = $this->courses->get($id);
        $city = $this->cities->get($form->cityId);
        $category = $this->categories->get($form->categories->main);

        $course->edit(
            $city->id,
            $form->name,
            $form->price,
            $form->description
        );

        $course->changeMainCategory($category->id);

        $this->transaction->wrap(function () use ($course, $form) {
            $this->courses->save($course);
            $this->indexer->remove($course);
            $this->indexer->index($course);
        });
    }


    public function createError($id, ErrorForm $form){

        $course = $this->courses->get($id);
        $course->createError($course->id, $form->message);
        $this->courses->save($course);
    }

    public function editError($id, ErrorForm $form){
        $error = $this->errors->getByCourseId($id);
        $error->edit($form->message);
        $this->errors->save($error);
    }


    public function activate($id): void
    {
        $course = $this->courses->get($id);
        $course->activate();
        $course->setDateActivate();
        $this->courses->save($course);
        $this->indexer->index($course);
    }

    public function draft($id): void
    {
        $course = $this->courses->get($id);
        $course->draft();
        $this->courses->save($course);
    }

    public function addPhotos($id, PhotosForm $form): void
    {
        $course = $this->courses->get($id);
        foreach ($form->files as $file) {
            $course->addPhoto($file);
        }
        $this->courses->save($course);
    }

    public function addGallery($id, GalleryForm $form): void
    {
        $course = $this->courses->get($id);
        foreach ($form->gallery as $galleryItem) {
            $course->addGalleryImage($galleryItem);
        }
        $this->courses->save($course);
    }


    public function removePhoto($id, $photoId): void
    {
        $course = $this->courses->get($id);
        $course->removePhoto($photoId);
        $this->courses->save($course);
    }

    public function removeGallery($id, $galleryItemId): void
    {
        $course = $this->courses->get($id);
        $course->removeGalleryImage($galleryItemId);
        $this->courses->save($course);
    }

    public function sendOnModeration(Course $course){
        $course->onModeration();
        $this->courses->save($course);
    }

    public function failureCourse(Course $course){
        $course->failure();
        $this->courses->save($course);
    }


    public function remove($id): void
    {
        $course = $this->courses->get($id);
        $this->courses->remove($course);
    }
}