<?php

namespace shop\repositories;

use shop\entities\user\Payment;
use shop\repositories\NotFoundException;

class PaymentRepository
{
    public function get($id): Payment
    {
        if (!$payment = Payment::findOne($id)) {
            throw new NotFoundException('Information is not found.');
        }
        return $payment;
    }



    public function save(Payment $payment): void
    {
        if (!$payment->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Payment $payment): void
    {
        if (!$payment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}