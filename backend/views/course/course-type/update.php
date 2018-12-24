<?php

/* @var $this yii\web\View */
/* @var $courseType shop\entities\shop\CourseType */
/* @var $model shop\forms\manage\shop\CourseTypeForm*/

$this->title = 'Изменить: ' . $courseType->name;
$this->params['breadcrumbs'][] = ['label' => 'Типи курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $courseType->name, 'url' => ['view', 'id' => $courseType->id]];
?>
<div class="characteristic-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
