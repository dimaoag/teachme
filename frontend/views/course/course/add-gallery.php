<?php



use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $course shop\entities\shop\course\Course */
/* @var $galleryForm \shop\forms\manage\shop\course\GalleryForm */

$this->title = 'Добавить фото в галерею';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


?>
<main>
    <div class="container add-course">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item active_tab1" id="list_description_info">
                    Галерея
                </li>
            </ul>
            <div class="tab-content create-course">
                <div class="tab-pane active step-2" id="description_info">
                    <?php $form = ActiveForm::begin([
                        'id' => 'course_add_gallery',
                        'options' => ['enctype'=>'multipart/form-data']
                    ]); ?>
                    <div class="panel panel-default form-horizontal">
                        <div class="panel-body">
                            <div class="upload-image">
                                <h2>Фотогалерея курса</h2>
                                <?= $form->field($galleryForm, 'gallery[]')->fileInput(['id' => 'edit_gallery', 'multiple' => true, 'data-url' => Url::to(['update', 'id' => $course->id])])->label(false); ?>
                            </div>
                            <div class="step-2-buttons">
                                <div class="col-xs-6">
                                    <div align="center">
                                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-block button-pure btn-lg']) ?>
                                    </div>
                                </div>
                            </div>
                            <br />
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
