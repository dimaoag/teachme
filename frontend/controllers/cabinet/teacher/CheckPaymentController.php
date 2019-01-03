<?php

namespace frontend\controllers\cabinet\teacher;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use shop\services\manage\PaymentManageService;

class CheckPaymentController extends Controller
{

    private $paymentManageService;

    public function __construct($id, $module, PaymentManageService $paymentManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->paymentManageService = $paymentManageService;

    }


    public function actionIndex()
    {
        if (isset($_POST['data'])){

            $result= json_decode(base64_decode($_POST['data']));
            // данные вернуться в base64 формат JSON
            if ($result->status == 'sandbox'){
                // обновим статус заказа
                $this->paymentManageService->statusCompleted($result->order_id);
                Yii::$app->session->setFlash('success', 'Заказ успешно оплачен');
                return $this->render('thanks', [

                ]);
            } else {
                $this->paymentManageService->statusCanceled($result->order_id);
                Yii::$app->session->setFlash('error', 'Оплатить заказ неудалось. Попробуйте еще раз.');
                return $this->redirect(['/']);
            }
        }
        return $this->render('thanks', [

        ]);
    }
}