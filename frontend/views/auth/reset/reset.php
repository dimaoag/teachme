<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model ResetPasswordForm */

use shop\forms\auth\ResetPasswordForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Изменение пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<main>
    <div class="container-login100 bg-login">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <span class="login100-form-title p-b-25 login-title">
                   Изменение пароля
            </span>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= $form->field($model, 'code')->input('number',['placeholder' => 'Введите код'])->label('Введите код с SMS'); ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput()->label('Новый пароль *'); ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password_confirm')->passwordInput()->label('Повторить пароль *'); ?>
                    </div>
                </div>
                <?= Html::submitButton('Изменить', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</main>
