<?php


use kartik\widgets\Select2;
use shop\helpers\UserHelper;
use yii\helpers\Url;

use kartik\widgets\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\shop\course\CourseCreateForm */

$this->title = 'Создать курс';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


?>
<main>
    <div class="container add-course">
        <div class="row">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form-inline',
                'options' => ['enctype'=>'multipart/form-data', 'id' => 'add_course_form']
            ]); ?>

                <ul class="nav nav-tabs">
                    <li class="nav-item active_tab1" id="list_main_info">
                        Краткая информация
                    </li>
                </ul>
                <div class="tab-content create-course">
                    <div class="tab-pane active step-1" id="main_info">
                        <div class="panel panel-default form-horizontal">
                            <div class="upload-image">
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <h4>Выберите изображения курса</h4>
                                        <?= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
                                            'options' => [
                                                'accept' => 'image/*',
                                            ],
                                            'pluginOptions' => [
                                                'browseOnZoneClick' => true,
                                                'showBrowse' => true,
                                                'showUpload' => false,
                                                'overwriteInitial' => true,
                                                'browseClass' => 'btn btn-purple',
                                                'removeClass' => 'btn btn-default',
                                            ],
                                        ])->label(false); ?>

                                    </div>
                                    <div class="clearfix"></div>
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
                                    <label class="col-sm-2 control-label" for="courseTypeId">Тип курса</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select main-select-city">
                                                <?= $form->field($model, 'courseTypeId')->dropDownList($model->courseTypesList(), ['id' => 'courseTypeId', 'prompt' => 'Выберите тип...'])->label(false); ?>
                                            </div>
                                        </div>
                                        <span id="error_courseTypeId" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="cityId">Город</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select">
                                                <?= $form->field($model, 'cityId')->widget(Select2::class, [
                                                    'data' => $model->citiesList(),
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
                                    <label class="col-sm-2 control-label" for="firmId">Организация</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select main-select-city">
                                                <?php if (!Yii::$app->user->isGuest): ?>
                                                    <?php if ($firm = UserHelper::getUserFirm(Yii::$app->user->id)): ?>
                                                        <?php /** @var $firm \shop\entities\shop\TeacherMainInfo */ ?>
                                                        <?= $form->field($model, 'firmId')->dropDownList($model->firmList(), ['id' => 'firmId', 'prompt' => 'Выберите организацию...', 'value' => $firm->id])->label(false); ?>
                                                    <?php else: ?>
                                                        <?= Html::a('Создать организацию',[Url::to(['/cabinet/teacher/default/teacher-main-info'])], ['class' => 'link-create-firm']); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>

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
                                    <div class="col-sm-12">
                                        <div class="add-course-price-field">
                                            <?= $form->field($model, 'price')->input('number')->label(false); ?>
                                            <p class="form-currency">грн.</p>
                                        </div>
                                        <span id="error_price" class="text-danger"></span>
                                        <div class="course-radio-list-wrap">
                                            <?= $form->field($model, 'priceModificationId')->radioList($model->priceModificationList(), ['inline'=>true, 'class' => 'course-radio-list', 'value' => $model->priceModificationDefaultValue()])->label(false); ?>
                                        </div>
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

                                <div class="form-group bottom-block">

                                    <?php foreach ($model->values as $i => $value): ?>
                                        <div class="col-sm-6 value-container">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="characteristic_{$i}"><?= $value->getName();?></label>
                                                <div class="col-sm-7 header-search-city">
                                                    <div class="add-course-select">
                                                        <div class="custom-select main-select-city">
                                                            <?php if ($variants = $value->variantsList()): ?>
                                                                <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => 'Выбрать...', 'id' => "characteristic_{$i}"])->label(false); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <span id="error_type_education" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group create-course-description">
                                    <div class="col-xs-12">
                                        <label class="control-label" for="create_description">Описание</label>

                                        <?= $form->field($model, 'description')->textarea(['rows' => 15, 'class' => 'create-course-textarea', 'id' => 'create_description'])->label(false); ?>
                                        <span id="error_description" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-7">
                                    <div align="center">
                                        <button type="submit" name="btn_main_info" id="btn_main_info" class="btn btn-block btn-lg button-pure">Далее</button>
                                    </div>
                                </div>

                                <br />
                            </div>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</main>
