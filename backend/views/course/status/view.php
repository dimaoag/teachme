<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $status shop\entities\shop\Status */

$this->title = $status->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $status->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $status->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Статус</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $status,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Название',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
