<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $modelLearner shop\forms\auth\SignupLearner */

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
                <?php $form = ActiveForm::begin(['id' => 'signup-learner-form', 'action' => ['/signup-learner'], 'options' => ['class' => 'login100-form tab-form active']]); ?>
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
                <form class="login100-form tab-form" role="form">
                    <div class="form-group">
                        <label for="first_name">Имя *</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="Введите имя" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Фамилия</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Введите фамилию">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон *</label>
                        <input type="text" data-mask="callback-catalog-phone" class="form-control" id="phone"
                               name="phone" placeholder="Введите телефон" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль *</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Пароль"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Повторить пароль *</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                               placeholder="Повторить пароль" required>
                    </div>
                    <button class="btn btn-block login100-form-btn btn-login">Зарегистрироваться</button>
                </form>
                <!--User form end-->
            </div>
            <div class="m-t-40">
                <span class="star-require">* - обязательные поля для заполнения</span>
            </div>
        </div>
    </div>
</main>
