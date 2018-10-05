<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\ConfirmPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтверждения телефона';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'confirm-password-form']); ?>

            <?= $form->field($model, 'confirm_code')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
