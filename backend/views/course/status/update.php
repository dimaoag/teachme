<?php

/* @var $this yii\web\View */
/* @var $status shop\entities\shop\Status */
/* @var $model shop\forms\manage\shop\StatusForm */

$this->title = 'Изменить статус: ' . $status->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $status->name, 'url' => ['view', 'id' => $status->id]];
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
