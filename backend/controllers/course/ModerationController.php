<?php

namespace backend\controllers\course;


use backend\forms\course\CourseOnModerationSearch;
use shop\services\manage\CourseManageService;
use shop\services\manage\UserManegeService;
use shop\forms\manage\shop\course\ErrorForm;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\Error;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class ModerationController extends Controller
{
    private $courseManageService;
    private $userManageService;

    public function __construct($id, $module, CourseManageService $courseManageService, UserManegeService $userManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->courseManageService = $courseManageService;
        $this->userManageService = $userManageService;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'activate' => ['POST'],
                ],
            ],
        ];
    }




    public function actionIndex()
    {
        $searchModel = new CourseOnModerationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $course = $this->findModel($id);
        $error = $this->findErrorModel($course->id);


        if (!$error){
            $errorForm = new ErrorForm();
        } else {
            $errorForm = new ErrorForm($course->error);

        }


        if ($errorForm->load(Yii::$app->request->post()) && $errorForm->validate()) {
            try {
                if (!$error){
                    $this->courseManageService->createError($course->id, $errorForm);
                } else {
                    $this->courseManageService->editError($course->id, $errorForm);
                }

                $this->userManageService->plusPublication(Yii::$app->user->id, $course->courseType->id);
                $this->courseManageService->failureCourse($course);
                return $this->redirect(['index']);

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        return $this->render('view', [
            'course' => $course,
            'errorForm' => $errorForm,
        ]);
    }


    public function actionActivate($id)
    {
        try {
            $this->courseManageService->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    protected function findModel($id): Course
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findErrorModel($id)
    {
        if ($model = Error::find()->andWhere(['course_id' => $id])->limit(1)->one()) {
            return $model;
        }
        return false;
    }
}
