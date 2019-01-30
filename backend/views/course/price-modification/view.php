<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $priceModification \shop\entities\shop\course\PriceModification */

$this->title = $priceModification->title;
$this->params['breadcrumbs'][] = ['label' => 'Все модификации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $priceModification->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $priceModification->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Модификация цены</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $priceModification,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'label' => 'Название',
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
