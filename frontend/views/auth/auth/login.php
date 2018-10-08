<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model LoginForm */

use shop\forms\auth\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use  yii\helpers\Url;

$this->title = 'Вход на сайт';
$this->params['breadcrumbs'][] = $this->title;
?>

<main>
    <div class="container-login100 bg-login">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <div class="dws-form">
                <span class="login100-form-title p-b-15 login-title">
                       Войти
                </span>
                <?php $form = ActiveForm::begin(['id' => 'loginForm', 'options' => ['class' => 'login100-form tab-form active']]); ?>
                    <div class="form-group">
                        <?= $form->field($model, 'phone')->label('Телефон')->input('text', ['data-mask' => 'callback-catalog-phone']); ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput()->label('Пароль *'); ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'rememberMe')->checkbox(); ?>
                    </div>
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="m-t-40">
                <a href="<?= Url::to(['/request'])?>" class="txt2 hov1">
                    Забыли пароль
                </a>
                <a href="<?= Url::to(['/signup'])?>" class="txt2 hov1 float-r">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
</main>
