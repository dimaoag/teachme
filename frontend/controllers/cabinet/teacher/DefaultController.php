<?php
namespace frontend\controllers\cabinet\teacher;


use frontend\forms\UserSearch;
use shop\entities\shop\course\Course;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\user\User;
use shop\forms\manage\user\ProfileEditForm;
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
use shop\services\user\ProfileService;
use shop\forms\manage\user\ProfileEditPasswordForm;

class DefaultController extends Controller {

    private $users;
    private $courses;
    private $teacherMainInfoService;
    private $teacherMainInfoRepository;
    private $profileService;

    public function __construct(string $id, Module $module,
        UserRepository $users,
        CourseRepository $courses,
        TeacherMainInfoManageService $teacherMainInfoService,
        TeacherMainInfoRepository $teacherMainInfoRepository,
        ProfileService $profileService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->users = $users;
        $this->courses = $courses;
        $this->teacherMainInfoService = $teacherMainInfoService;
        $this->teacherMainInfoRepository = $teacherMainInfoRepository;
        $this->profileService = $profileService;
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


        $user = $this->users->getUserById(Yii::$app->user->id);
        $profileEditForm = new ProfileEditForm($user);
        $profileEditPasswordForm = new ProfileEditPasswordForm($user);


        return $this->render('index', [
            'publications' => $publications,
            'courses' => $courses,
            'teacherMainInfoForm' => $teacherMainInfoForm,
            'teacherMainInfo' => $teacherMainInfo,
            'profileEditForm' => $profileEditForm,
            'profileEditPasswordForm' => $profileEditPasswordForm,
        ]);
    }




    public function actionTeacherMainInfo(){

        $teacherMainInfo = $this->teacherMainInfoRepository->getTeacherMainInfoByUserId(Yii::$app->user->id) ?: null;
        $teacherMainInfo ? $teacherMainInfoForm = new TeacherMainInfoForm($teacherMainInfo) : $teacherMainInfoForm = new TeacherMainInfoForm();

        if ($teacherMainInfoForm->load(Yii::$app->request->post()) && $teacherMainInfoForm->validate()) {
            try {
                !$teacherMainInfo ?  $this->teacherMainInfoService->create($teacherMainInfoForm) : $this->teacherMainInfoService->edit($teacherMainInfo->id,$teacherMainInfoForm);
                Yii::$app->session->setFlash('success', 'Данные успешно изменены');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        return $this->render('index', [
            'teacherMainInfoForm' => $teacherMainInfoForm,
            'teacherMainInfo' => $teacherMainInfo,
        ]);
    }



    public function actionEditProfile(){

        $user = $this->users->getUserById(Yii::$app->user->id);

        $profileEditForm = new ProfileEditForm($user);
        if ($profileEditForm->load(Yii::$app->request->post()) && $profileEditForm->validate()) {
            try {
                $this->profileService->edit($user->id, $profileEditForm);
                Yii::$app->session->setFlash('success', 'Данные успешно изменены');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        return $this->render('index', [
            'profileEditForm' => $profileEditForm,
        ]);
    }




    public function actionEditProfilePassword(){

        $user = $this->users->getUserById(Yii::$app->user->id);

        $profileEditPasswordForm = new ProfileEditPasswordForm($user);
        if ($profileEditPasswordForm->load(Yii::$app->request->post()) && $profileEditPasswordForm->validate()) {
            try {
                $this->profileService->changePassword($user->id, $profileEditPasswordForm);
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'profileEditPasswordForm' => $profileEditPasswordForm,
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
            Yii::$app->session->setFlash('success', 'Фото успешно удалено');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }




}