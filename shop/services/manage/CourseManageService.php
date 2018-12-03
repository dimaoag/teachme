<?php

namespace shop\services\manage;

use shop\entities\shop\course\Course;
use shop\forms\manage\shop\course\CategoriesForm;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\repositories\shop\CityRepository;
use shop\repositories\shop\CategoryRepository;
use shop\repositories\shop\CourseRepository;
use shop\services\TransactionManager;
use Yii;

class CourseManageService
{
    private $courses;
    private $cities;
    private $categories;
    private $transaction;

    public function __construct(
        CourseRepository $courses,
        CityRepository $cities,
        CategoryRepository $categories,
        TransactionManager $transaction
    )
    {
        $this->courses = $courses;
        $this->cities = $cities;
        $this->categories = $categories;
        $this->transaction = $transaction;
    }

    public function create(CourseCreateForm $form): Course
    {
        $city = $this->cities->get($form->cityId);
        $category = $this->categories->get($form->categories->main);

        $course = Course::create(
            Yii::$app->user->id,
            $city->id,
            $category->id,
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

        foreach ($form->gallery->files as $galleryImage) {
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

            foreach ($form->values as $value) {
                $course->setValue($value->id, $value->value);
            }

            $this->courses->save($course);
        });
    }


    public function activate($id): void
    {
        $course = $this->courses->get($id);
        $course->activate();
        $this->courses->save($course);
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
        foreach ($form->files as $galleryItem) {
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


    public function remove($id): void
    {
        $course = $this->courses->get($id);
        $this->courses->remove($course);
    }
}