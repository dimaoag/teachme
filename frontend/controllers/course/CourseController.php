<?php
namespace frontend\controllers\course;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\services\manage\CourseManageService;
use shop\helpers\UserHelper;

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
                        'roles' => ['@'],
                        'actions' => ['create'],
                    ],
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

        if (!UserHelper::isUserTeacher()){
            return $this->redirect(['/']);
        }

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

}