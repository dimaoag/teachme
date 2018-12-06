<?php

use shop\entities\shop\course\Course;
use shop\helpers\CourseHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\course\CourseOnModerationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курсы на модерации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
//                'rowOptions' => ['style' => 'text-align: center'],
                'columns' => [
                    [
                        'label' => 'Фото',
                        'value' => function (Course $model) {
                            return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    [
                        'attribute' => 'name',
                        'value' => function (Course $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Дата создания',
                        'value' => function (Course $course) {
                            return CourseHelper::echoDate($course->created_at);
                        },
                    ],
                    [
                        'attribute' => 'first_name',
                        'label' => 'Имя',
                        'value' => 'user.first_name',
                    ],
                    [
                        'attribute' => 'last_name',
                        'label' => 'Фамилия',
                        'value' => 'user.last_name',
                    ],
                    'id',
                ],
            ]); ?>
        </div>
    </div>
</div>
