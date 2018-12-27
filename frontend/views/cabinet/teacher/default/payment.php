<?php
/* @var $this yii\web\View */
/* @var $publications array */
/* @var $courseTypes \shop\entities\shop\CourseType[] */
/* @var $courseType \shop\entities\shop\CourseType */
/* @var $paymentForm \shop\forms\manage\user\PaymentForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Оплата';
$this->params['active_payments'] = 'active';
?>

<div class="tab-cabinet-container tab-price active">
    <h2>Услуги для бизнеса</h2>
    <div class="row">
        <div class="col-md-10">
            <?php if (!empty($courseTypes)): ?>
                <?php foreach($courseTypes as $courseType): ?>
<!--                    <form class="form-price">-->
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'form-price'
                            ],
                        ]) ?>

                        <?= $form->field($paymentForm, 'courseTypeId')->hiddenInput(['value' => $courseType->id])->label(false); ?>
                        <?= $form->field($paymentForm, 'price')->hiddenInput(['value' => $courseType->price])->label(false); ?>
                        <?= $form->field($paymentForm, 'quantity')->hiddenInput(['value' => 1, 'class' => 'quantity-input'])->label(false); ?>
                        <?= $form->field($paymentForm, 'sum')->hiddenInput(['value' => $courseType->price, 'class' => 'sum-input'])->label(false); ?>
                        <div class="form-price-item first-block">
                            <p class="payment-course-name"><?= Html::encode($courseType->name); ?></p>
                        </div>
                        <div class="form-price-item second-block">
                            <p><span class="payment-price-text" data-price="<?= Html::encode($courseType->price); ?>"><?= Html::encode($courseType->price); ?></span> грн</p>
                            <s><small><span class="payment-old_price-text" data-old_price="<?= Html::encode($courseType->old_price); ?>"><?= Html::encode($courseType->old_price); ?></span> грн</small></s>
                        </div>
                        <div class="form-price-item third-block header-search-city">
                            <p>Количество</p>
                            <div class="price-select">
                                <select name="qty" class="select-quantity-publicactions">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-price-item fourth-block">
                            <button type="submit" class="btn btn-block button-pure">Купить</button>
                        </div>
                <?php ActiveForm::end() ?>
<!--                    </form>-->
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
