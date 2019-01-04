<?php
namespace frontend\controllers\cabinet\teacher;


use frontend\forms\OrderSearch;
use frontend\forms\UserSearch;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\Order;
use shop\entities\shop\CourseType;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\user\User;
use shop\forms\course\order\OrderEditForm;
use shop\forms\manage\user\PaymentForm;
use shop\forms\manage\user\ProfileEditForm;
use shop\helpers\UserHelper;
use shop\readModels\shop\CourseReadRepository;
use shop\repositories\PaymentRepository;
use shop\repositories\shop\OrderRepository;
use shop\repositories\shop\TeacherMainInfoRepository;
use shop\services\manage\CourseManageService;
use shop\services\manage\PaymentManageService;
use shop\services\manage\UserManegeService;
use Yii;
use yii\base\Module;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\AccessControl;
use shop\repositories\UserRepository;
use shop\repositories\shop\CourseRepository;
use shop\forms\manage\shop\TeacherMainInfoForm;
use shop\services\manage\TeacherMainInfoManageService;
use shop\services\user\ProfileService;
use shop\forms\manage\user\ProfileEditPasswordForm;
use shop\services\manage\OrderCommentManageService;
use shop\forms\course\order\OrderCommentCreateForm;
use shop\payment\LiqPay;
class DefaultController extends Controller {

    public $layout = 'cabinet';


    private $users;
    private $courses;
    private $orders;
    private $teacherMainInfoService;
    private $teacherMainInfoRepository;
    private $profileService;
    private $courseManageService;
    private $orderCommentManageService;
    private $paymentManageService;
    private $paymentRepository;
    private $courseReadRepository;

    public function __construct(string $id, Module $module,
        UserRepository $users,
        CourseRepository $courses,
        OrderRepository $orders,
        TeacherMainInfoManageService $teacherMainInfoService,
        TeacherMainInfoRepository $teacherMainInfoRepository,
        ProfileService $profileService,
        CourseManageService $courseManageService,
        OrderCommentManageService $orderCommentManageService,
        PaymentManageService $paymentManageService,
        PaymentRepository $paymentRepository,
        CourseReadRepository $courseReadRepository,
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
        $this->orderCommentManageService = $orderCommentManageService;
        $this->paymentManageService = $paymentManageService;
        $this->paymentRepository = $paymentRepository;
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
                    'delete-firm-photo' => ['POST'],
                    'delete-order-comment' => ['POST'],
                ],
            ],
        ];
    }



    public function actionIndex(){

        // with ActiveDataProvider
//        $dataProvider = new ActiveDataProvider([
//            'query' => User::find(),
//            'pagination' => array('pageSize' => 50),
//        ]);
//
//        echo \yii\widgets\LinkPager::widget([
//            'pagination'=>$dataProvider->pagination,
//        ]);


        $query = Course::find()->where(['user_id' => Yii::$app->user->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>20]);
        $courses = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        $user = $this->users->getUserById(Yii::$app->user->id);
        $courseTypes = CourseType::find()->all();

        $publications = [];

        foreach ($courseTypes as $courseType){
            /** @var CourseType $courseType */
            $publications[$courseType->name] = ArrayHelper::getValue($user->getPublication($courseType->id), 'quantity') ? ArrayHelper::getValue($user->getPublication($courseType->id), 'quantity') : '0';

        }


        return $this->render('index', [
            'publications' => $publications,
            'courses' => $courses,
            'pages' => $pages,
        ]);
    }

    public function actionOrders()
    {
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

        $orderCommentCreateForm = new OrderCommentCreateForm();

        if ($orderCommentCreateForm->load(Yii::$app->request->post()) && $orderCommentCreateForm->validate()) {
            try {
                $orderComment = $this->orderCommentManageService->create($orderCommentCreateForm);
//                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
                return $this->asJson(['success' => true, 'comment' => $orderComment, 'url' => Url::to(['delete-order-comment'], true)]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }



        return $this->render('orders', [
            'orders' => $orders,
            'orderEditForms' => $orderEditForms,
            'courses' => $courses,
            'orderCommentCreateForm' => $orderCommentCreateForm,
        ]);
    }


    public function actionOrdersByCourse($id)
    {

        $courses = $this->courses->getCoursesByUserId(Yii::$app->user->id);
        $course = $this->courses->get($id);

        $user = $this->users->getUserById(Yii::$app->user->id);
        $orders = $this->orders->getOrdersByTeacherIdAndCourseId($user->id, $id);
        $orderEditForms = [];
        if (!empty($orders)){
            foreach ($orders as $order){
                /** @var Order $order */
                $orderEditForms[$order->id] = new OrderEditForm($order);
            }
        }

        $orderCommentCreateForm = new OrderCommentCreateForm();
        if ($orderCommentCreateForm->load(Yii::$app->request->post()) && $orderCommentCreateForm->validate()) {
            try {
                $orderComment = $this->orderCommentManageService->create($orderCommentCreateForm);
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        return $this->render('orders', [
            'orders' => $orders,
            'orderEditForms' => $orderEditForms,
            'courses' => $courses,
            'course' => $course,
            'orderCommentCreateForm' => $orderCommentCreateForm,
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
        $user = $this->users->getUserById(Yii::$app->user->id);
        $courseTypes = CourseType::find()->all();

        $paymentForm = new PaymentForm();
        if ($paymentForm->load(Yii::$app->request->post()) && $paymentForm->validate()) {
            try {
                $payment = $this->paymentManageService->create($user->id, $paymentForm);
                return $this->redirect(['checkout', 'id' => $payment->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('payment', [
            'courseTypes' => $courseTypes,
            'user' => $user,
            'paymentForm' => $paymentForm,
        ]);
    }

    public function actionCheckout($id)
    {
        $payment = $this->paymentRepository->get($id);

        if (Yii::$app->user->id != $payment->user_id){
            return $this->redirect(Yii::$app->request->referrer ?: ['index']);
        }

        return $this->render('checkout', [
            'payment' => $payment,
        ]);
    }

    public function actionPay()
    {
        if (Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            $payment = $this->paymentRepository->get($id);

            if (Yii::$app->user->id != $payment->user_id){
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            }

            $html = $this->paymentManageService->createForm($payment);

            $res_arr = array("status"=>1, 'form'=>$html, 'order_num'=>$payment->id);
//            echo json_encode( $res_arr ); // вернем нашу сгенерированную форму для отправки покупателя на LiqPay
            return $this->asJson($res_arr);
        } else {
            return $this->redirect(Yii::$app->request->referrer ?: ['index']);
        }
    }


    public function actionThanks()
    {
        return $this->render('thanks', [

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

    public function actionDeleteOrderComment()
    {
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            try {
                $this->orderCommentManageService->remove($id);
                return 'success';
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
                return 'error';
            }
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
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