<?php
namespace frontend\controllers\cabinet\teacher;


use frontend\forms\UserSearch;
use shop\entities\shop\course\Course;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use shop\repositories\shop\TeacherMainInfoRepository;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\AccessControl;
use shop\repositories\UserRepository;
use shop\repositories\shop\CourseRepository;
use shop\forms\manage\shop\TeacherMainInfoForm;
use shop\services\manage\TeacherMainInfoManageService;

class DefaultController extends Controller {

    private $users;
    private $courses;
    private $teacherMainInfoService;
    private $teacherMainInfoRepository;

    public function __construct(string $id, Module $module,
        UserRepository $users,
        CourseRepository $courses,
        TeacherMainInfoManageService $teacherMainInfoService,
        TeacherMainInfoRepository $teacherMainInfoRepository,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->users = $users;
        $this->courses = $courses;
        $this->teacherMainInfoService = $teacherMainInfoService;
        $this->teacherMainInfoRepository = $teacherMainInfoRepository;
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
                    'delete-firm-photo' => ['POST'],
                ],
            ],
        ];
    }



    public function actionIndex(){

        $publications = User::find()
            ->select('publications')
            ->where(['id' => Yii::$app->user->id])
            ->one();
        $publications = ArrayHelper::getValue($publications,'publications');

        $courses = $this->courses->getCoursesByUserId(Yii::$app->user->id);



        /**
         * @var $teacherMainInfo TeacherMainInfo;
         */
        $teacherMainInfo = $this->teacherMainInfoRepository->getTeacherMainInfoByUserId(Yii::$app->user->id) ?: null;
        $teacherMainInfo ? $teacherMainInfoForm = new TeacherMainInfoForm($teacherMainInfo) : $teacherMainInfoForm = new TeacherMainInfoForm();

        if ($teacherMainInfoForm->load(Yii::$app->request->post()) && $teacherMainInfoForm->validate()) {
            try {
                !$teacherMainInfo ?  $this->teacherMainInfoService->create($teacherMainInfoForm) : $this->teacherMainInfoService->edit($teacherMainInfo->id,$teacherMainInfoForm);
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        return $this->render('index', [
            'publications' => $publications,
            'courses' => $courses,
            'teacherMainInfoForm' => $teacherMainInfoForm,
            'teacherMainInfo' => $teacherMainInfo,
        ]);
    }



    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteFirmPhoto($id)
    {
        try {
            $this->teacherMainInfoService->removePhoto($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }




}