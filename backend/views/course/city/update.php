<?php

/* @var $this yii\web\View */
/* @var $city shop\entities\shop\City */
/* @var $model shop\forms\manage\shop\CityForm */

$this->title = 'Изменить город: ' . $city->name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $city->name, 'url' => ['view', 'id' => $city->id]];
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
