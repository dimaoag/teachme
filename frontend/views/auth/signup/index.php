<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $modelLearner shop\forms\auth\SignupLearnerForm */
/* @var $modelTeacher shop\forms\auth\SignupTeacherForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<main>
    <div class="container-login100 bg-login">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <div class="dws-form">
                <span class="login100-form-title p-b-15 login-title signup-title">
                       Зарегистрироваться как
                </span>
                <div class="label-wrap p-b-15">
                    <label class="tab active" title="tab-1">Пользователь</label>
                    <label class="tab" title="tab-2">Компания</label>
                </div>
                <!--User form start-->
                <?php $form = ActiveForm::begin(['id' => 'formLearner', 'action' => ['/signup'], 'options' => ['class' => 'login100-form tab-form active']]); ?>
                <div class="form-group">
                    <?= $form->field($modelLearner, 'first_name')->textInput()->label('Имя *'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelLearner, 'phone')->label('Телефон *')->input('text', ['data-mask' => 'callback-catalog-phone']); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelLearner, 'password')->passwordInput()->label('Пароль *'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelLearner, 'password_confirm')->passwordInput()->label('Повторить пароль *'); ?>
                </div>
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
                <?php ActiveForm::end(); ?>
                <!--User form end-->

                <!--Agent form start-->
                <?php $form = ActiveForm::begin(['id' => 'formTeacher', 'action' => ['/signup'], 'options' => ['class' => 'login100-form tab-form']]); ?>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'first_name')->textInput()->label('Имя *'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'last_name')->textInput()->label('Фамилия'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'phone')->label('Телефон *')->input('text', ['data-mask' => 'callback-catalog-phone']); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'email')->input('email')->label('Email *'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'password')->passwordInput()->label('Пароль *'); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($modelTeacher, 'password_confirm')->passwordInput()->label('Повторить пароль *'); ?>
                </div>
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
                <?php ActiveForm::end(); ?>
                <!--Agent form end-->
            </div>
            <div class="m-t-40">
                <span class="star-require">* - обязательные поля для заполнения</span>
            </div>
        </div>
    </div>
</main>
