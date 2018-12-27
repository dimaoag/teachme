<?php

/* @var $this yii\web\View */
/* @var $payment \shop\entities\user\Payment */


use yii\helpers\Html;

$this->title = 'Оформления заказа';
?>

<div class="tab-cabinet-container tab-checkout active">
    <h2>Оформление заказа на публикации</h2>
    <div class="row">
        <div class="col-md-5">
            <?php if (!empty($payment)): ?>
                <form class="form-checkout">
                    <div class="form-checkout-item">
                        <p class="form-checkout-title">Тип обучения:</p>
                        <p class="form-checkout-value form-checkout-value-course-name"><?= Html::encode($payment->courseType->name); ?></p>
                    </div>
                    <div class="form-checkout-item">
                        <p class="form-checkout-title">Цена:</p>
                        <p class="form-checkout-value"><?= Html::encode($payment->price); ?> грн.</p>
                    </div>
                    <div class="form-checkout-item">
                        <p class="form-checkout-title">Количество:</p>
                        <p class="form-checkout-value"><?= Html::encode($payment->quantity); ?> шт.</p>
                    </div>
                    <div class="form-checkout-item">
                        <p class="form-checkout-title">Сума:</p>
                        <p class="form-checkout-value"><?= Html::encode($payment->sum); ?> грн.</p>
                    </div>
                    <div class="form-price-item fourth-block">
                        <button type="submit" class="btn btn-block button-pure checkout-btn">Оплатить</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
