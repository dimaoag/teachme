<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $characteristic shop\entities\shop\Characteristic */

$this->title = $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $characteristic->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $characteristic->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этую запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $characteristic,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Название',
                    ],
                    [
                        'attribute' => 'sort',
                        'label' => 'Сортировка',
                    ],
                    [
                        'attribute' => 'required',
                        'label' => 'Обязательное',
                        'format' => 'boolean',

                    ],
                    [
                        'attribute' => 'variants',
                        'value' => implode(PHP_EOL, $characteristic->variants),
                        'format' => 'ntext',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
