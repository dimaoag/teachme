<?php
/* @var $this yii\web\View */

/* @var $teacherMainInfoForm \shop\forms\manage\shop\TeacherMainInfoForm */
/* @var $teacherMainInfo \shop\entities\shop\TeacherMainInfo*/


use yii\helpers\Html;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;



$this->title = 'Настройки организации';
$this->params['active_teacher_main_info'] = 'active';
?>


<div class="tab-cabinet-container tab-main-info active">
    <h2 class="tab-main-info-title">Добавьте основную информацию по организации</h2>
    <div class="row edit-firm-photo">
        <?php if (!empty($teacherMainInfo->firm_photo)):?>
            <div class="col-sm-5 col-xs-12 edit-main-photo-wrap">
                <div class="btn-group edit-delete-btn">
                    <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-firm-photo', 'id' => $teacherMainInfo->id], [
                        'class' => 'btn btn-default',
                        'data-method' => 'post',
                        'data-confirm' => 'Вы действилътельно хотите удалить этот елемент?',
                    ]); ?>
                </div>
                <?= Html::img($teacherMainInfo->getThumbFileUrl('firm_photo', 'thumb')); ?>
            </div>
        <?php endif; ?>
        <div class="col-md-10">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data', 'id' => 'teacher_main_info']
            ]); ?>
            <div class="add-photo-profile">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if (empty($teacherMainInfo->firm_photo)):?>
                                <h4>Выберите изображения организации</h4>
                                <?= $form->field($teacherMainInfoForm, 'firm_photo')->widget(FileInput::class, [
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
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 main-form-field-item">
                        <?= $form->field($teacherMainInfoForm, 'firm_name')->textInput(['maxlength' => true]); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6 main-form-field-item header-search-city">
                        <?= $form->field($teacherMainInfoForm, 'city_id')->dropDownList($teacherMainInfoForm->getCitiesList(), ['id' => 'city_id', 'prompt' => 'Выберите город...', 'class' => 'select-with-scroll teacher_main_info_city_select']); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-10 main-form-field-item">
                        <?= $form->field($teacherMainInfoForm, 'address')->textInput(['maxlength' => true]); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-5 main-form-field-item">
                        <div class="main-info-form-field main-info-field-phone">
                            <?= $form->field($teacherMainInfoForm, 'phone_1')->textInput(); ?>
                        </div>
                        <div class="main-info-form-field main-info-field-phone">
                            <?= $form->field($teacherMainInfoForm, 'phone_2')->textInput(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 main-form-field-item">
                        <label>Ссылки на соц сети</label>
                        <div class="main-info-form-field main-info-field-socs instagram-field">
                            <i class="fa fa-instagram"></i>
                            <?= $form->field($teacherMainInfoForm, 'instagram_link')->textInput()->label(false); ?>
                        </div>
                        <div class="main-info-form-field main-info-field-socs facebook-field">
                            <i class="fa fa-facebook"></i>
                            <?= $form->field($teacherMainInfoForm, 'facebook_link')->textInput()->label(false); ?>
                        </div>
                        <div class="main-info-form-field main-info-field-socs telegram-field">
                            <i class="fa fa-paper-plane"></i>
                            <?= $form->field($teacherMainInfoForm, 'vk_link')->textInput()->label(false); ?>
                        </div>
                        <div class="main-info-form-field main-info-field-socs youtube-field">
                            <i class="fa fa-youtube-play"></i>
                            <?= $form->field($teacherMainInfoForm, 'youtube_link')->textInput()->label(false); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-r">
                <button type="submit" class="btn button-pure">Сохранить данные</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
