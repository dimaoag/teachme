<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model PasswordResetRequestForm */

use shop\forms\auth\PasswordResetRequestForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = ['label' => 'Вход на сайт', 'url' => '/login'];
$this->params['breadcrumbs'][] = $this->title;
?>

<main>
    <div class="container-login100 bg-login">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <span class="login100-form-title p-b-25 login-title">
                   Восстановление пароля
            </span>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <div class="form-group">
                    <?= $form->field($model, 'phone')->label('Телефон')->input('text', ['data-mask' => 'callback-catalog-phone']); ?>
                </div>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
            <?php ActiveForm::end(); ?>
            <div class="m-t-40" align="center">
                <span>На указаный телефон прийдет SMS с паролем</span>
            </div>
        </div>
    </div>
</main>