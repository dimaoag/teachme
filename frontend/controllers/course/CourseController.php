<?php
namespace frontend\controllers\course;


use shop\forms\course\order\OrderCreateForm;
use shop\forms\course\ReviewForm;
use shop\helpers\CourseHelper;
use shop\readModels\course\CategoryReadRepository;
use shop\readModels\course\CityReadRepository;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\entities\shop\course\Course;
use yii\helpers\VarDumper;
use yii\web\Controller;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\services\manage\CourseManageService;
use shop\helpers\UserHelper;
use yii\web\NotFoundHttpException;
use shop\services\manage\UserManegeService;
use shop\forms\course\search\SearchForm;
use shop\readModels\course\CourseReadRepository;
use shop\readModels\course\TeacherMainInfoReadRepository;
use shop\forms\auth\LoginForm;
use frontend\controllers\AppController;

class CourseController extends AppController{


    private $service;
    private $userManageService;
    private $courseReadRepository;
    private $categories;
    private $cities;
    private $firms;

    public function __construct($id, $module,
        CourseManageService $service,
        UserManegeService $userManageService,
        CourseReadRepository $courseReadRepository,
        CategoryReadRepository $categories,
        CityReadRepository $cities,
        TeacherMainInfoReadRepository $firms,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->userManageService = $userManageService;
        $this->courseReadRepository = $courseReadRepository;
        $this->categories = $categories;
        $this->cities = $cities;
        $this->firms = $firms;
    }


    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete', 'delete-photo', 'delete-gallery-item', 'on-moderation'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return (UserHelper::isUserTeacher()) ? true : false ;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'delete' => ['POST'],
                    'delete-photo' => ['POST'],
                    'delete-gallery-item' => ['POST'],
                    'delete-review' => ['POST'],
                ],
            ],
        ];
    }




    public function actionView($id){
        $course = $this->findModel($id);

        if ($course->status != Course::STATUS_ACTIVE){
            Yii::$app->session->setFlash('error', 'Курс не активирован');
            return $this->redirect(Yii::$app->request->referrer ?: ['/']);
        }


        $reviewForm = new ReviewForm();
        if ($reviewForm->load(Yii::$app->request->post()) && $reviewForm->validate()) {
            try {
                $this->service->addReview(Yii::$app->user->id, $course->id, $reviewForm);
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        $orderCreateForm = new OrderCreateForm();

        if ($orderCreateForm->load(Yii::$app->request->post()) && $orderCreateForm->validate()) {
            try {
                $this->service->createOrder($orderCreateForm);
                Yii::$app->session->setFlash('success', 'Вы успешно записались на курс');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        $loginForm = new LoginForm();

        return $this->render('view', [
            'course' => $course,
            'reviewForm' => $reviewForm,
            'orderCreateForm' => $orderCreateForm,
            'loginForm' => $loginForm,
        ]);
    }


    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->courseReadRepository->getAllByCategory($category);

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }




    public function actionFirm($id)
    {
        $loginForm = new LoginForm();
        if (!$firm = $this->firms->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->courseReadRepository->getAllByFirm($firm);

        return $this->render('firm', [
            'firm' => $firm,
            'dataProvider' => $dataProvider,
            'loginForm' => $loginForm,
        ]);
    }



    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CourseCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $course = $this->service->create($form);
                return $this->redirect(['/course/course/add-gallery', 'id' => $course->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }



    public function actionAddGallery($id)
    {
        $course = $this->findModel($id);
        $galleryForm = new GalleryForm();

        if ($galleryForm->load(Yii::$app->request->post()) && $galleryForm->validate()) {
            try {
                $this->service->addGallery($course->id, $galleryForm);
                return $this->redirect(['/cabinet/teacher/default/index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('add-gallery', [
            'course' => $course,
            'galleryForm' => $galleryForm,
        ]);
    }


    public function actionUpdate($id)
    {
        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }
        $galleryForm = new GalleryForm();
        $photosForm = new PhotosForm();

        if(Yii::$app->request->isAjax){
            $galleryName = $galleryForm->formName();
            $photoName = $photosForm->formName();

            if (isset($_FILES[$photoName])){
                if ($photosForm->validate()){
                    $this->service->addPhotos($course->id, $photosForm);
                    return $this->asJson(['success' => 1]);
                }
            }
            if (isset($_FILES[$galleryName])){
                if ($galleryForm->validate()){
                    $this->service->addGallery($course->id, $galleryForm);
                    return $this->asJson(['success' => 1]);
                }
            }
            return $this->asJson(['error' => 0]);
        }


        $form = new CourseEditForm($course);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($course->id, $form);
                return $this->redirect(['/cabinet/teacher']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

//        $photosForm = new PhotosForm();
//        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
//            try {
//                $this->service->addPhotos($course->id, $photosForm);
//                return $this->redirect(['update', 'id' => $course->id]);
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }
//
//        $galleryForm = new GalleryForm();
//
//        if ($galleryForm->load(Yii::$app->request->post()) && $galleryForm->validate()) {
//            try {
//                $this->service->addGallery($course->id, $galleryForm);
//                return $this->redirect(['update', 'id' => $course->id]);
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }

        return $this->render('update', [
            'model' => $form,
            'course' => $course,
        ]);
    }



    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['update', 'id' => $id]);
    }


    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeleteGalleryItem($id, $photo_id)
    {
        try {
            $this->service->removeGallery($id, $photo_id);
            return $this->asJson(['res' => 1]);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
//        return $this->redirect(['update', 'id' => $id]);
    }



    public function actionDelete($id)
    {
        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }

        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }




    public function actionOnModeration($id){

        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }


        if (!UserHelper::checkPublications(Yii::$app->user->id, $course->courseType->id)){
            Yii::$app->session->setFlash('error', 'У Вас нету публикаций для категории '.$course->courseType->name);
            return $this->redirect(Yii::$app->request->referrer ?: ['/']);
        }


        try {
            $this->service->sendOnModeration($course);
            $this->userManageService->minusPublication(Yii::$app->user->id, $course->courseType->id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }



    public function actionDisable($id){

        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }

        try {
            $this->service->disable($course);
            Yii::$app->session->setFlash('success', 'Курс деактивировано');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }


    public function actionDeleteReview($id, $course_id){

        $course = $this->findModel($course_id);

        try {
            $this->service->removeReview((int)$id, $course->id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }


    /**
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Course
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }




}