<?php

namespace shop\services\manage;

use shop\entities\user\Payment;
use shop\forms\manage\user\PaymentForm;
use shop\repositories\PaymentRepository;
use shop\payment\LiqPay;
use Yii;


class PaymentManageService
{
    private $repository;


    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($userId, PaymentForm $form): Payment
    {
        $payment = Payment::create(
            $form->courseTypeId,
            $userId,
            $form->price,
            $form->quantity,
            $form->sum
        );

        $this->repository->save($payment);
        return $payment;
    }


    public function statusCompleted($id)
    {
        $payment = $this->repository->get($id);
        $payment->statusCompleted();
        $this->repository->save($payment);
    }

    public function statusCanceled($id)
    {
        $payment = $this->repository->get($id);
        $payment->statusCancelled();
        $this->repository->save($payment);
    }


    public function createForm(Payment $payment)
    {
        $liqpay = new LiqPay(Yii::$app->params['pay_public_key'], Yii::$app->params['pay_private_key']);

        $html = $liqpay->cnb_form(array(
            'version'=>'3',
            'action'         => 'pay',
            'amount'         => $payment->sum, // сумма заказа
            'currency'       => 'UAH',
            /* перед этим мы ведь внесли заказ в  таблицу,
            $insert_id = $wpdb->query( 'insert into table_orders' );
            */
            'description'    => 'Оплата заказа № '.$payment->id,
            'order_id'       => $payment->id,
            // если пользователь возжелает вернуться на сайт
            'result_url'	=>	Yii::$app->params['pay_result_url'],
            /*
                если не вернулся, то Webhook LiqPay скинет нам сюда информацию из формы,
                в частонсти все тот же order_id, чтобы заказ
                 можно было обработать как оплаченый
            */
            'server_url'	=>	Yii::$app->params['pay_server_url'],
            'language'		=>	'ru' // uk, en
            //'sandbox'=>'1' // и куда же без песочницы,
            // не на реальных же деньгах тестировать
        ));
        return $html;
    }

    public function remove($id): void
    {
        $payment = $this->repository->get($id);
        $this->repository->remove($payment);
    }
}