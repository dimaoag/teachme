<?php

/* @var $this yii\web\View */
/* @var $priceModification \shop\entities\shop\course\PriceModification */
/* @var $model \shop\forms\manage\shop\course\PriceModificationForm */

$this->title = 'Изменить модификацию: ' . $priceModification->title;
$this->params['breadcrumbs'][] = ['label' => 'Все модификации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $priceModification->title, 'url' => ['view', 'id' => $priceModification->id]];
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
