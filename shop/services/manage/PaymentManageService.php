<?php

namespace shop\services\manage;

use shop\entities\user\Payment;
use shop\forms\manage\user\PaymentForm;
use shop\repositories\PaymentRepository;


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


    public function remove($id): void
    {
        $payment = $this->repository->get($id);
        $this->repository->remove($payment);
    }
}