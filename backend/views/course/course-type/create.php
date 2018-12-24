<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\CourseTypeForm */

$this->title = 'Добавить тип курса';
$this->params['breadcrumbs'][] = ['label' => 'Типы курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
