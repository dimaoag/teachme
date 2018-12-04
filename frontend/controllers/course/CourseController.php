<?php
namespace frontend\controllers\course;


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

class CourseController extends Controller{


    private $service;

    public function __construct($id, $module, CourseManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }


    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return (!Yii::$app->user->isGuest && UserHelper::isUserTeacher()) ? true : false ;
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

        if (Yii::$app->user->id != $course->user_id){
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

        if (Yii::$app->user->id != $course->user_id){
            return $this->redirect(['/']);
        }

        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
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