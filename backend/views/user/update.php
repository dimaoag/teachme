<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\user\UserEditForm*/
/* @var $user shop\entities\user\User */

$this->title = 'Изменить пользователя: ' . $user->first_name . " " . $user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->first_name.' ' .$user->last_name, 'url' => ['view', 'id' => $user->id]];
?>
<div class="user-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'first_name')->textInput(['maxLength' => true]); ?>
    <?= $form->field($model,'last_name')->textInput(['maxLength' => true]); ?>
    <?= $form->field($model,'phone')->textInput(['maxLength' => true]); ?>
    <?= $form->field($model,'email')->textInput(['maxLength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
