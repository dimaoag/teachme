<?php

/* @var $this yii\web\View */
/* @var $payment \shop\entities\user\Payment */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Оформления заказа';
?>

<div class="tab-cabinet-container tab-checkout active">
    <h2>Оформление заказа на публикации</h2>
    <div class="row">
        <div class="col-md-5 form-checkout-wrap">
            <?php if (!empty($payment)): ?>
                <div class="form-checkout">
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
                        <button type="submit" class="btn btn-block button-pure checkout-btn send_order" data-url="<?= Url::to(['pay'], true); ?>" data-id="<?=$payment->id ?>">Оплатить</button>
                    </div>
                </div>
                <div id="lpay_form"></div>
            <?php endif; ?>
        </div>
    </div>
</div>
