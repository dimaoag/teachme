<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $loginForm \shop\forms\auth\LoginForm */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use yii\helpers\Url;



AppAsset::register($this);
FontAwesomeAsset::register($this);
$loginForm = isset($this->params['loginForm']) ? $this->params['loginForm'] : null;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?=Url::base()?>/js/modernizr.js"></script>
</head>
<body>
    <?php $this->beginBody() ?>

    <?= $content ?>


    <div id="courses-login" class="white-popup mfp-hide">
        <h5 class="text-center">Чтобы добавить курс в избраное нужно ввойти на сайт или <a href="<?=Url::to(['/signup'])?>">зарегистрироваться</a></h5>
        <div class="course-info-footer">

            <?php $form = ActiveForm::begin(['id' => 'loginForm', 'action' => Url::to(['/login']), 'options' => ['class' => 'login100-form tab-form active']]); ?>
            <div class="form-group">
                <?= $form->field($loginForm, 'phone')->label('Телефон')->input('text', ['data-mask' => 'callback-catalog-phone']); ?>
            </div>
            <div class="form-group">
                <?= $form->field($loginForm, 'password')->passwordInput()->label('Пароль *'); ?>
            </div>
            <div class="form-group">
                <?= $form->field($loginForm, 'rememberMe')->checkbox(); ?>
            </div>
            <?= Html::submitButton('Войти', ['class' => 'btn btn-block login100-form-btn btn-login']); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
