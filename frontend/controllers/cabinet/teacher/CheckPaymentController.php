<?php

namespace frontend\controllers\cabinet\teacher;


use shop\entities\user\Payment;
use Yii;
use yii\web\Controller;
use shop\services\manage\PaymentManageService;
use shop\services\manage\UserManegeService;

class CheckPaymentController extends Controller
{

    private $paymentManageService;
    private $userManageService;
    public $enableCsrfValidation = false;

    public function __construct($id, $module, PaymentManageService $paymentManageService, UserManegeService $userManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->paymentManageService = $paymentManageService;
        $this->userManageService = $userManageService;

    }


//    public function beforeAction($action)
//    {
//        if ($action->id == 'index' || $action->id == 'thanks' || $action->id == 'failure') {
//            $this->enableCsrfValidation = false;
//        }
//
//        return parent::beforeAction($action);
//    }


    public function actionIndex()
    {
        if (isset($_POST['data'])){

            $result= json_decode(base64_decode($_POST['data']));
            // данные вернуться в base64 формат JSON
            if ($result->status == 'sandbox'){
                // обновим статус заказа
                /** @var  $payment Payment */
                $payment = $this->paymentManageService->statusCompleted($result->order_id);
                $this->userManageService->plusPublication($payment);
                Yii::$app->session->setFlash('success', 'Заказ успешно оплачен');
//                return $this->redirect(['thanks']);
            } else {
                $this->paymentManageService->statusCanceled($result->order_id);
                Yii::$app->session->setFlash('error', 'Оплатить заказ неудалось. Попробуйте еще раз.');
                return $this->redirect(['failure']);
            }
        }

    }

    public function actionThanks(){
        return $this->render('thanks', [

        ]);
    }

    public function actionFailure(){
        return $this->render('failure', [

        ]);
    }
}