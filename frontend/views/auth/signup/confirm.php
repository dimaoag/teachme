<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\ConfirmPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтверждения телефона';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container-login100 bg-login">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <span class="login100-form-title p-b-25 login-title">
                   Подтверждения телефона
            </span>
            <!--Confirm_phone form start-->
            <?php $form = ActiveForm::begin(['id' => 'confirm-phone-form', 'options' => ['class' => 'login100-form']]); ?>
                <div class="form-group">
                    <?= $form->field($model, 'confirm_code')->input('number',['placeholder' => 'Введите код'])->label('Введите код с SMS'); ?>
                </div>
            <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
            <?php ActiveForm::end(); ?>
            <!--Confirm_phone form end-->
        </div>
    </div>
</main>
