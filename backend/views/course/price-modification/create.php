<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\shop\course\PriceModificationForm */

$this->title = 'Добавить модификацию';
$this->params['breadcrumbs'][] = ['label' => 'Все модификации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
