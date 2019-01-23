<?php

/* @var $profileEditForm \shop\forms\manage\user\ProfileEditForm*/
/* @var $profileEditPasswordForm \shop\forms\manage\user\ProfileEditPasswordForm*/
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;


$this->title = 'Кабинет пользователя';

?>

<main>
    <div class="container cabinet-user">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Кабинет пользователя</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?php $form = ActiveForm::begin(['id' => 'profileEditForm']); ?>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Имя</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditForm, 'first_name')->textInput(['id' => 'first_name', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-sm-4 control-label">Фамилия</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditForm, 'last_name')->textInput(['id' => 'last_name', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">Телефон</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditForm, 'phone')->textInput(['id' => 'phone', 'maxlength' => true, 'data-mask' => 'callback-catalog-phone'])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditForm, 'email')->textInput(['id' => 'email', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить данные</button>
                        <br>
                    </div>
                </div>
                <?php $form = ActiveForm::end(); ?>
                <br>
                <?php $form = ActiveForm::begin(['id' => 'profileEditPasswordForm']); ?>
                <div class="form-group">
                    <label for="oldPassword" class="col-sm-4 control-label">Старый пароль</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditPasswordForm, 'oldPassword')->passwordInput(['id' => 'oldPassword', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password1" class="col-sm-4 control-label">Новый пароль</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditPasswordForm, 'password1')->passwordInput(['id' => 'password1', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2" class="col-sm-4 control-label">Подтвердить пароль</label>
                    <div class="col-sm-8">
                        <?= $form->field($profileEditPasswordForm, 'password2')->passwordInput(['id' => 'password2', 'maxlength' => true])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить пароль</button>
                    </div>
                </div>
                <?php $form = ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</main>