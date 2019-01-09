<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model shop\entities\user\User */
/* @var $model \shop\forms\manage\user\UserCreateForm */

$this->title = 'Создать нового пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,'first_name')->textInput(['maxLength' => true]); ?>
        <?= $form->field($model,'last_name')->textInput(['maxLength' => true]); ?>
        <?= $form->field($model,'phone')->textInput(['maxLength' => true, 'data-mask' => 'callback-catalog-phone']); ?>
        <?= $form->field($model,'email')->textInput(['maxLength' => true]); ?>
        <?= $form->field($model,'password')->passwordInput(['maxLength' => true]); ?>
        <?= $form->field($model, 'designation')->dropDownList($model->designationList()); ?>
        <?= $form->field($model, 'role')->dropDownList($model->rolesList()); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
