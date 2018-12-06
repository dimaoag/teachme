<?php

use shop\entities\shop\course\Value;
use shop\entities\shop\course\Course;
use shop\helpers\CourseHelper;
use yii\bootstrap\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $course shop\entities\shop\course\Course */
/* @var $errorForm shop\forms\manage\shop\course\ErrorForm */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $course->id;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php if ($course->isOnModeration()): ?>
            <?= Html::a('Активировать', ['activate', 'id' => $course->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#hide_gallery_input">Отклонить</button>
        <?php endif; ?>
    </p>

    <div id="hide_gallery_input" class="collapse">
        <div class="row">
            <div class="col-md-7">
                <div class="box">
                    <div class="box-body">
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($errorForm, 'message')->textarea(['rows' => 4]); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отклонить', ['class' => 'btn btn-danger']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-7">
            <div class="box">
                <div class="box-header with-border">Курс</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $course,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'status',
                                'label' => 'Статус',
                                'value' => CourseHelper::getStatus($course),
                            ],
                            [
                                'attribute' => 'name',
                                'label' => 'Название',

                            ],
                            [
                                'attribute' => 'city_id',
                                'label' => 'Город',
                                'value' => ArrayHelper::getValue($course, 'city.name'),
                            ],
                            [
                                'attribute' => 'category_id',
                                'label' => 'Категория',
                                'value' => ArrayHelper::getValue($course, 'category.name'),
                            ],
                            [
                                'attribute' => 'user_id',
                                'label' => 'Пользователь',
                                'value' => ArrayHelper::getValue($course, 'user.first_name') . ' ' . ArrayHelper::getValue($course, 'user.last_name'),
                            ],
                            [
                                'attribute' => 'price',
                                'label' => 'Цена',
                            ],
                            [
                                'attribute' => 'created_at',
                                'label' => 'Дата создания',
                                'value' => function (Course $course) {
                                    return CourseHelper::echoDate($course->created_at);
                                },
                            ],
                        ],
                    ]) ?>
                    <br />
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Описание курса</div>
        <div class="box-body">
            <?= $course->description; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Характеристики</div>
                <div class="box-body">

                    <?= DetailView::widget([
                        'model' => $course,
                        'attributes' => array_map(function (Value $value) {
                            return [
                                'label' => $value->characteristic->name,
                                'value' => $value->value,
                            ];
                        }, $course->values),
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box" id="photos">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($course->photos as $photo): ?>
                    <div class="col-md-2 col-xs-3" style="text-align: center">
                        <div>
                            <?= Html::a(
                                Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                $photo->getUploadedFileUrl('file'),
                                ['class' => 'thumbnail', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="box" id="photos">
        <div class="box-header with-border">Галерея</div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($course->gallery as $photo): ?>
                    <div class="col-md-2 col-xs-3" style="text-align: center">
                        <div>
                            <?= Html::a(
                                Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                $photo->getUploadedFileUrl('file'),
                                ['class' => 'thumbnail', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
