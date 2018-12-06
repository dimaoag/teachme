<?php

namespace backend\controllers\course;


use backend\forms\course\CourseOnModerationSearch;
use shop\services\manage\CourseManageService;
use shop\services\manage\UserManegeService;
use shop\entities\shop\course\Course;
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


        return $this->render('view', [
            'course' => $course,
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
}
