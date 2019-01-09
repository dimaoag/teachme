<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\user\PublicationChangeForm*/
/* @var $course_type_id integer*/
/* @var $user_id integer*/

$this->title = 'Изменить количество публикаций';
$this->params['breadcrumbs'][] = ['label' => 'публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,'courseTypeId')->hiddenInput(['value' => $course_type_id])->label(false); ?>
        <?= $form->field($model,'userId')->hiddenInput(['value' => $user_id])->label(false); ?>
        <?= $form->field($model,'quantity')->textInput(); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
