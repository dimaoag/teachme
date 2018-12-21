<?php
namespace frontend\controllers\cabinet\teacher;


use frontend\forms\OrderSearch;
use frontend\forms\UserSearch;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\Order;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\user\User;
use shop\forms\course\order\OrderEditForm;
use shop\forms\manage\user\ProfileEditForm;
use shop\helpers\UserHelper;
use shop\repositories\shop\OrderRepository;
use shop\repositories\shop\TeacherMainInfoRepository;
use shop\services\manage\CourseManageService;
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

    public $layout = 'cabinet';


    private $users;
    private $courses;
    private $orders;
    private $teacherMainInfoService;
    private $teacherMainInfoRepository;
    private $profileService;
    private $courseManageService;

    public function __construct(string $id, Module $module,
        UserRepository $users,
        CourseRepository $courses,
        OrderRepository $orders,
        TeacherMainInfoManageService $teacherMainInfoService,
        TeacherMainInfoRepository $teacherMainInfoRepository,
        ProfileService $profileService,
        CourseManageService $courseManageService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->users = $users;
        $this->courses = $courses;
        $this->orders = $orders;
        $this->teacherMainInfoService = $teacherMainInfoService;
        $this->teacherMainInfoRepository = $teacherMainInfoRepository;
        $this->profileService = $profileService;
        $this->courseManageService = $courseManageService;
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


        return $this->render('index', [
            'publications' => $publications,
            'courses' => $courses,
        ]);
    }

    public function actionOrders()
    {

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $courses = $this->courses->getCoursesByUserId(Yii::$app->user->id);

        $user = $this->users->getUserById(Yii::$app->user->id);
        $orders = $this->orders->getOrdersByTeacherId($user->id);
        $orderEditForms = [];
        if (!empty($orders)){
            foreach ($orders as $order){
                /** @var Order $order */
                $orderEditForms[$order->id] = new OrderEditForm($order);
            }
        }

        return $this->render('orders', [
            'orders' => $orders,
            'orderEditForms' => $orderEditForms,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'courses' => $courses,
        ]);
    }


    public function actionOrdersByCourse($id)
    {

        $courses = $this->courses->getCoursesByUserId(Yii::$app->user->id);
        $course = $this->courses->get($id);

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user = $this->users->getUserById(Yii::$app->user->id);
        $orders = $this->orders->getOrdersByTeacherIdAndCourseId($user->id, $id);
        $orderEditForms = [];
        if (!empty($orders)){
            foreach ($orders as $order){
                /** @var Order $order */
                $orderEditForms[$order->id] = new OrderEditForm($order);
            }
        }

        return $this->render('orders', [
            'orders' => $orders,
            'orderEditForms' => $orderEditForms,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'courses' => $courses,
            'course' => $course,
        ]);
    }


    public function actionTeacherMainInfo()
    {

        /**
         * @var $teacherMainInfo TeacherMainInfo;
         */
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

        return $this->render('teacherMainInfo', [
            'teacherMainInfoForm' => $teacherMainInfoForm,
            'teacherMainInfo' => $teacherMainInfo,
        ]);
    }

    public function actionProfile()
    {

        $user = $this->users->getUserById(Yii::$app->user->id);

        $profileEditForm = new ProfileEditForm($user);
        if ($profileEditForm->load(Yii::$app->request->post())) {
            if ($profileEditForm->validate()){
                try {
                    $this->profileService->edit($user->id, $profileEditForm);
                    Yii::$app->session->setFlash('success', 'Данные успешно изменены');
                    return $this->redirect(Yii::$app->request->referrer ?: ['index']);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка. Данные не изменены');
            }
        }


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

        return $this->render('profile', [
            'profileEditForm' => $profileEditForm,
            'profileEditPasswordForm' => $profileEditPasswordForm,
        ]);
    }

    public function actionPayment()
    {


        return $this->render('payment', [

        ]);
    }



    public function actionEditOrder()
    {
        $orderEditForm = new OrderEditForm();
        if ($orderEditForm->load(Yii::$app->request->post()) && $orderEditForm->validate()) {
            try {
                $this->courseManageService->editOrder($orderEditForm);
                Yii::$app->session->setFlash('success', 'Заявку успешно изменено');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

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