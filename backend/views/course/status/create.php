<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\shop\StatusForm */

$this->title = 'Добавить статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
