<?php

namespace shop\services\manage;

use shop\entities\shop\course\Course;
use shop\forms\course\order\OrderEditForm;
use shop\forms\manage\shop\course\ErrorForm;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\repositories\shop\CityRepository;
use shop\repositories\shop\CategoryRepository;
use shop\repositories\shop\CourseRepository;
use shop\repositories\shop\CourseTypeRepository;
use shop\repositories\shop\ErrorRepository;
use shop\repositories\shop\OrderRepository;
use shop\repositories\shop\PriceModificationRepository;
use shop\repositories\shop\ReviewRepository;
use shop\repositories\shop\TeacherMainInfoRepository;
use shop\forms\course\order\OrderCreateForm;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;
use shop\services\search\CourseIndexer;
use Yii;
use shop\forms\course\ReviewForm;
use yii\mail\MailerInterface;

class CourseManageService
{
    private $users;
    private $courses;
    private $cities;
    private $priceModifications;
    private $courseTypes;
    private $errors;
    private $categories;
    private $indexer;
    private $teachersMainInfo;
    private $reviews;
    private $orders;
    private $mailer;
    private $transaction;

    public function __construct(
        UserRepository $users,
        CourseRepository $courses,
        CityRepository $cities,
        PriceModificationRepository $priceModifications,
        CourseTypeRepository $courseTypes,
        ErrorRepository $errors,
        CategoryRepository $categories,
        CourseIndexer $indexer,
        TeacherMainInfoRepository $teachersMainInfo,
        ReviewRepository $reviews,
        OrderRepository $orders,
        MailerInterface $mailer,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->courses = $courses;
        $this->cities = $cities;
        $this->priceModifications = $priceModifications;
        $this->courseTypes = $courseTypes;
        $this->errors = $errors;
        $this->categories = $categories;
        $this->indexer = $indexer;
        $this->teachersMainInfo = $teachersMainInfo;
        $this->reviews = $reviews;
        $this->orders = $orders;
        $this->mailer = $mailer;
        $this->transaction = $transaction;
    }

    public function create(CourseCreateForm $form): Course
    {
        $city = $this->cities->get($form->cityId);
        $courseType = $this->courseTypes->get($form->courseTypeId);
        $category = $this->categories->get($form->categories->main);
        $teacherMainInfo = $this->teachersMainInfo->get($form->firmId);
        $priceModification = $this->priceModifications->get($form->priceModificationId);

        $course = Course::create(
            Yii::$app->user->id,
            $city->id,
            $courseType->id,
            $teacherMainInfo->id,
            $category->id,
            $priceModification->id,
            $form->name,
            $form->price,
            $form->old_price,
            $form->description
        );


        foreach ($form->values as $value) {
            $course->setValue($value->id, $value->value);
        }

        foreach ($form->photos->files as $file) {
            $course->addPhoto($file);
        }

//        foreach ($form->gallery->gallery as $galleryImage) {
//            $course->addGalleryImage($galleryImage);
//        }


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
        $priceModification = $this->priceModifications->get($form->priceModificationId);

        $course->edit(
            $city->id,
            $priceModification->id,
            $form->name,
            $form->price,
            $form->old_price,
            $form->description
        );

        $course->changeMainCategory($category->id);

        if ($form->photos){
            foreach ($form->photos->files as $file) {
                $course->addPhoto($file);
            }
        }

        if ($form->gallery){
            foreach ($form->gallery->gallery as $galleryImage) {
                $course->addGalleryImage($galleryImage);
            }
        }


        $this->transaction->wrap(function () use ($course) {
            $this->courses->save($course);
            if ($course->status == Course::STATUS_ACTIVE){
                $this->indexer->remove($course);
                $this->indexer->index($course);
            }
        });

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

    public function sendOnModeration(Course $course){
        $course->onModeration();
        $this->courses->save($course);
    }

    public function disable(Course $course){
        $course->deactivate();
        $this->indexer->remove($course);
        $this->courses->save($course);
    }

    public function failureCourse(Course $course){
        $course->failure();
        $this->courses->save($course);
    }


    public function remove($id): void
    {
        $course = $this->courses->get($id);
        if ($course->status == Course::STATUS_ACTIVE){
            $this->indexer->remove($course);
        }
        $this->courses->remove($course);
    }

    public function checkOwn($userId, $courseId): bool
    {
        $course = $this->courses->get($courseId);
        return $course->user_id == $userId;
    }

    //errors on moderation

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




    //photos

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



    //reviews

    public function addReview($userId, $courseId, ReviewForm $form): void
    {
        $course = $this->courses->get($courseId);
        $course->addReview(
            $userId,
            $form->vote,
            $form->text
        );
        $this->courses->save($course);
        if ($course->status == Course::STATUS_ACTIVE){
            $this->indexer->remove($course);
            $this->indexer->index($course);
        }
    }


    public function removeReview($reviewId, $courseId): void
    {
        $course = $this->courses->get($courseId);
        $review = $this->reviews->get($reviewId);
        $course->removeReview($review->id);
        $this->courses->save($course);
        if ($course->status == Course::STATUS_ACTIVE){
            $this->indexer->remove($course);
            $this->indexer->index($course);
        }
    }


    //orders

    public function createOrder(OrderCreateForm $form): void
    {
        $course = $this->courses->get($form->course_id);
        $user = $this->users->getUserById($form->teacher_id);
        $course->createOrder(
            $form->teacher_id,
            $form->username,
            $form->phone,
            $form->price
        );
        $this->courses->save($course);


        if (!empty($user->email)){
            $data = [
                'username' => $form->username,
                'phone' => $form->phone,
                'course_name' => $course->name,
                'course_id' => $course->id,
            ];


            $sent = $this
                ->mailer
                ->compose(
                    ['html' => 'order/emailOrderCreate-html', 'text' => 'order/emailOrderCreate-text'],
                    ['data' => $data]
                )
                ->setTo($user->email)
                ->setSubject('Заявка с сайта ' . ' Teach Me')
                ->send();
            if (!$sent){
                throw new \RuntimeException('Email sending error.');
            }
        }


    }


    public function editOrder(OrderEditForm $form): void
    {
        $order = $this->orders->get($form->order_id);
        $order->edit($form->title, $form->status);
        $this->orders->save($order);
    }


    public function deleteOrder($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }


}