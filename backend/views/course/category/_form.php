<?php


use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\shop\CategoryForm */
/* @var $category \shop\entities\shop\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Категория</div>
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?php if (!empty($category->cat_photo)):?>
                <div class="col-md-2 col-xs-3" style="text-align: center">
                    <div class="btn-group">

                    </div>
                    <div class="thumbnail">
                        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-category-photo', 'id' => $category->id], [
                            'class' => 'btn delete_cat_photo',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы действилътельно хотите удалить этот елемент?',
                        ]); ?>
                           <?= Html::img($category->getThumbFileUrl('cat_photo', 'thumb')); ?>
                    </div>
                </div>
            <?php else: ?>
                <h5>Выберите изображения (необязательно)</h5>
                <?= $form->field($model, 'cat_photo')->widget(FileInput::class, [
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

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
