<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $course shop\entities\shop\course\Course */
/* @var $model shop\forms\manage\shop\course\CourseEditForm */
/* @var $photosForm shop\forms\manage\shop\course\PhotosForm */
/* @var $galleryForm shop\forms\manage\shop\course\GalleryForm */

$this->title = 'Update course: ' . $course->name;
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
            <div class="tab-content">
                <div class="tab-pane active step-1" id="main_info">
                    <div class="panel panel-default form-horizontal">
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
                                <?php else: ?>
                                    <div class="col-md-8">
                                        <?php $formPhotos = ActiveForm::begin([
                                            'options' => ['enctype'=>'multipart/form-data'],
                                        ]); ?>

                                        <?= $formPhotos->field($photosForm, 'files[]')->widget(FileInput::class, [
                                            'options' => [
                                                'accept' => 'image/*',
                                            ],
                                            'pluginOptions' => [
                                                'browseOnZoneClick' => true,
                                                'showBrowse' => true,
                                                'showUpload' => true,
                                                'overwriteInitial' => true,
                                                'browseClass' => 'btn btn-purple',
                                                'removeClass' => 'btn btn-default',
                                                'uploadClass' => 'btn btn-success',
                                            ],
                                        ])->label(false); ?>


                                        <?php ActiveForm::end(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group edit-gallery-wrap">
                                <div class="upload-image">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="control-label">Фотогалерея курса</label>
                                        </div>

                                        <?php if (!empty($course->gallery)):?>
                                            <?php foreach ($course->gallery as $galleryItem): ?>
                                                <div class="col-md-4 col-sm-4 col-xs-6 edit-main-photo-wrap edit-gallery">
                                                    <div class="btn-group edit-delete-btn">
                                                        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-gallery-item', 'id' => $course->id, 'photo_id' => $galleryItem->id], [
                                                            'class' => 'btn btn-default',
                                                            'data-method' => 'post',
                                                            'data-confirm' => 'Вы действилътельно хотите удалить этот елемент?',
                                                        ]); ?>
                                                    </div>
                                                    <?= Html::img($galleryItem->getThumbFileUrl('file', 'thumb')); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-default btn-hide-gallery" data-toggle="collapse" data-target="#hide_gallery_input">Добавить файлы в галерею</button>
                                    </div>
                                    <div id="hide_gallery_input" class="collapse">
                                        <div class="row file-input-row">
                                            <?php $formGallery = ActiveForm::begin([
                                                'options' => ['enctype'=>'multipart/form-data'],
                                            ]); ?>

                                            <?= $formGallery->field($galleryForm, 'gallery[]')->widget(FileInput::class, [
                                                'options' => [
                                                    'accept' => 'image/*',
                                                    'multiple' => true,
                                                ],
                                                'pluginOptions' => [
                                                    'browseOnZoneClick' => true,
                                                    'showBrowse' => true,
                                                    'showUpload' => true,
                                                    'overwriteInitial' => true,
                                                    'browseClass' => 'btn btn-purple',
                                                    'removeClass' => 'btn btn-default',
                                                    'uploadClass' => 'btn btn-success',
                                                ],
                                            ])->label(false); ?>

                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">

                            <?php $form = ActiveForm::begin([
                                'id' => 'add_course_form',
                                'options' => ['enctype'=>'multipart/form-data']
                                ]); ?>

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
                                            <div class="custom-select main-select-city">
                                                <?= $form->field($model, 'cityId')->dropDownList($model->citiesList(), ['id' => 'city', 'prompt' => 'Выберите город...'])->label(false); ?>
                                            </div>
                                        </div>
                                        <span id="error_city" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="category">Рубрика</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select main-select-city">
                                                <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => 'Выберите категорию...'])->label(false); ?>
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
                                <div class="form-group description-edit">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="description">Описание курса</label>
                                        <?= $form->field($model, 'description')->textarea(['rows' => 15, 'id' => 'description'])->label(false); ?>
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
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

