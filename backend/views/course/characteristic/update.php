<?php

/* @var $this yii\web\View */
/* @var $characteristic shop\entities\shop\Characteristic */
/* @var $model shop\forms\manage\shop\CharacteristicForm */

$this->title = 'Изменить характеристику: ' . $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $characteristic->name, 'url' => ['view', 'id' => $characteristic->id]];
?>
<div class="characteristic-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
