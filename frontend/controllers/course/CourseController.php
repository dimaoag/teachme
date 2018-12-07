<?php
namespace frontend\controllers\course;


use shop\helpers\CourseHelper;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\entities\shop\course\Course;
use yii\web\Controller;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\services\manage\CourseManageService;
use shop\helpers\UserHelper;
use yii\web\NotFoundHttpException;
use shop\services\manage\UserManegeService;
use shop\forms\course\search\SearchForm;
use shop\readModels\shop\CourseReadRepository;

class CourseController extends Controller{


    private $service;
    private $userManageService;
    private $courseReadRepository;

    public function __construct($id, $module, CourseManageService $service,  UserManegeService $userManageService, CourseReadRepository $courseReadRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->userManageService = $userManageService;
        $this->courseReadRepository = $courseReadRepository;
    }


    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                    'delete' => ['POST'],
                    'delete-photo' => ['POST'],
                    'delete-gallery-item' => ['POST'],
                ],
            ],
        ];
    }




    public function actionIndex(){
        return $this->render('index');
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
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }




    public function actionUpdate($id)
    {
        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }


        $form = new CourseEditForm($course);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($course->id, $form);
//                return $this->redirect(['index', 'id' => $course->id]);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($course->id, $photosForm);
                return $this->redirect(['update', 'id' => $course->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $galleryForm = new GalleryForm();

        if ($galleryForm->load(Yii::$app->request->post()) && $galleryForm->validate()) {
            try {
                $this->service->addGallery($course->id, $galleryForm);
                return $this->redirect(['update', 'id' => $course->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'course' => $course,
            'photosForm' => $photosForm,
            'galleryForm' => $galleryForm,
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
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['update', 'id' => $id]);
    }


    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }

        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    public function actionOnModeration($id){

        $course = $this->findModel($id);

        if (!CourseHelper::isUserCourse($id, Yii::$app->user->id)){
            return $this->redirect(['/']);
        }


        if (!UserHelper::checkPublications(Yii::$app->user->id)){
            Yii::$app->session->setFlash('error', 'У Вас нету публикаций!');
            return $this->redirect(Yii::$app->request->referrer ?: ['/']);
        }


        try {
            $this->service->sendOnModeration($course);
            $this->userManageService->minusPublication(Yii::$app->user->id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }

    public function actionSearch()
    {
        $form = new SearchForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->courseReadRepository->search($form);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
        ]);
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