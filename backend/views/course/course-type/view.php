<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $courseType shop\entities\shop\CourseType */

$this->title = $courseType->name;
$this->params['breadcrumbs'][] = ['label' => 'Типи курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $courseType->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $courseType->id], [
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
                'model' => $courseType,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'name',
                    ],
                    [
                        'attribute' => 'price',
                    ],
                    [
                        'attribute' => 'old_price',
                    ],
                    [
                        'attribute' => 'sort',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
