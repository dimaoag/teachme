<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $course shop\entities\shop\course\Course */
/* @var $model shop\forms\manage\shop\course\CourseEditForm */


$this->title = 'Редактирование курса: ' . $course->name;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $course->name, 'url' => ['view', 'id' => $course->id]];
//$this->params['breadcrumbs'][] = 'Update';


?>

<main>
    <div class="container add-course">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item active_tab1">
                    Редактирование курса
                </li>
            </ul>
            <div class="tab-content edit-course-wrap">
                <div class="tab-pane active step-1" id="main_info">
                    <div class="panel panel-default form-horizontal">
                        <?php $form = ActiveForm::begin([
                            'id' => 'firm_photo',
                            'options' => [
                                    'enctype'=>'multipart/form-data',
                                ],
                        ]); ?>
                            <div class="upload-image edit-course-photos">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" for="price">Главное фото курса</label>
                                    <br><br>
                                    <?php if (!empty($course->photos)):?>
                                        <?php foreach ($course->photos as $photo): ?>
                                            <div class="col-sm-5 col-xs-12 edit-main-photo-wrap">
                                                <div class="btn-group edit-delete-btn">
                                                    <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'id' => $course->id, 'photo_id' => $photo->id], [
                                                        'class' => 'btn btn-default',
                                                        'data-method' => 'post',
                                                        'data-confirm' => 'Вы действилътельно хотите удалить этот елемент?',
                                                    ]); ?>
                                                </div>
                                                <?= Html::img($photo->getThumbFileUrl('file', 'thumb')); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                        <div class="col-md-8 hide-form-edit-photo" data-hide="<?= (!empty($course->photos)) ? '1' : '0'; ?>">
                                            <?= $form->field($model->photos, 'files[]')->fileInput(['id' => 'edit_photo_course', 'data-url' => Url::to(['', 'id' => $course->id])])->label(false); ?>
<!--                                            --><?php //= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
//                                                'options' => [
//                                                    'accept' => 'image/*',
//                                                    'id' => 'edit_photo'
//                                                ],
//                                                'pluginOptions' => [
//                                                    'browseOnZoneClick' => true,
//                                                    'showBrowse' => true,
//                                                    'showUpload' => false,
//                                                    'showRemove' => false,
//                                                    'overwriteInitial' => false,
//                                                    'browseClass' => 'btn btn-purple',
//                                                    'removeClass' => 'btn btn-default',
//                                                    'uploadUrl' => Url::to(['','id' => $course->id,]),
//                                                    'autoFitCaption' => true,
//                                                    'pluginLoading' => true,
//                                                    'initialPreviewAsData' => true,
//                                                    'initialPreview' => [$photosFirm],
//                                                    'initialPreviewConfig' => [$photosPreviewConfig],
//                                                    'fileActionSettings' => [
//                                                        'showDrag' => false,
//                                                        'showZoom' => true,
//                                                        'showUpload' => true,
//                                                        'showDelete' => false,
//                                                    ],
//                                                    'pluginEvents' =>
//                                                        [
//                                                            'change' => 'function(event) {
//                                                                alert("File changed");
//                                                            }'
//                                                        ],
//                                                ],
//                                            ])->label(false); ?>

                                        </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group edit-gallery-wrap">
                                    <div class="upload-image">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label class="control-label edit-label">Фотогалерея курса</label>
                                            </div>

                                            <?php if (!empty($course->gallery)):?>
                                                <?php foreach ($course->gallery as $galleryItem): ?>
                                                    <div class="col-md-4 col-sm-4 col-xs-6 edit-main-photo-wrap edit-gallery">
                                                        <div class="btn-group edit-delete-btn">
                                                            <a class="btn btn-default delete-gallery-item" href="<?= Url::to(['delete-gallery-item', 'id' => $course->id, 'photo_id' => $galleryItem->id], true); ?>" data-course_id="<?= $course->id; ?>" data-gallery_photo_id="<?= $galleryItem->id; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                                        </div>
                                                        <?= Html::img($galleryItem->getThumbFileUrl('file', 'thumb')); ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>
<!--                                        <div class="row">-->
<!--                                            <button type="button" class="btn btn-default btn-hide-gallery" data-toggle="collapse" data-target="#hide_gallery_input">Добавить файлы в галерею</button>-->
<!--                                        </div>-->
                                        <?= $form->field($model->gallery, 'gallery[]')->fileInput(['id' => 'edit_gallery', 'multiple' => true, 'data-url' => Url::to(['', 'id' => $course->id])])->label(false); ?>
                                        <div id="hide_gallery_input" class="collapse">
                                            <div class="row file-input-row">


<!--                                                --><?php //= $form->field($model->gallery, 'gallery[]')->widget(FileInput::class, [
//                                                    'options' => [
//                                                        'accept' => 'image/*',
//                                                        'multiple' => true,
//                                                        'id' => 'edit_gallery'
//                                                    ],
//                                                    'pluginOptions' => [
//                                                        'browseOnZoneClick' => true,
//                                                        'showBrowse' => true,
//                                                        'showUpload' => true,
//                                                        'maxFileSize' => 2048,
//                                                        'overwriteInitial' => false,
//                                                        'autoFitCaption' => true,
//                                                        'browseClass' => 'btn btn-purple',
//                                                        'removeClass' => 'btn btn-default',
//                                                        'uploadUrl' => Url::to(['','id' => $course->id,]),
//                                                        'pluginLoading' => true,
//                                                        'initialPreviewAsData' => true,
//                                                        'fileActionSettings' => [
//                                                            'showDrag' => false,
//                                                            'showZoom' => true,
//                                                            'showUpload' => true,
//                                                            'showDelete' => false,
//                                                        ],
//                                                    ],
//                                                ])->label(false); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name">Названия курса</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'name'])->label(false); ?>
                                        <span id="error_name" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="city">Город</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select">
                                                <?= $form->field($model, 'cityId')->widget(Select2::class, [
                                                    'data' => $model->citiesList(),
                                                    'language' => 'ru',
                                                    'options' => [
                                                        'placeholder' => 'Выберите город...',
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                ])->label(false); ?>
                                            </div>
                                        </div>
                                        <span id="error_city" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="category">Рубрика</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select">
                                                <?= $form->field($model->categories, 'main')->widget(Select2::class, [
                                                    'data' => $model->categories->categoriesList(),
                                                    'options' => [
                                                        'placeholder' => 'Выберите рубрику...',
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                ])->label(false); ?>

                                            </div>
                                        </div>
                                        <span id="error_category" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="price">Цена</label>
                                    <div class="col-sm-3">
                                        <div class="add-course-price-field">
                                            <?= $form->field($model, 'price')->input('number')->label(false); ?>
                                            <p class="form-currency">грн.</p>
                                        </div>
                                        <span id="error_price" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="old_price">Старая цена</label>
                                    <div class="col-sm-3">
                                        <div class="add-course-price-field">
                                            <?= $form->field($model, 'old_price')->input('number')->label(false); ?>
                                            <p class="form-currency">грн.</p>
                                        </div>
                                        <span id="error_price" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group description-edit">
                                    <div class="col-sm-12">
                                        <label class="control-label edit-label" for="description">Описание курса</label>
                                        <?= $form->field($model, 'description')->textarea(['rows' => 15, 'id' => 'description', 'class' => 'edit_course_textarea'])->label(false); ?>
                                        <span id="error_description" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6 float-r">
                                        <div align="center">
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-block button-pure btn-lg']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

