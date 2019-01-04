<?php

/* @var $this \yii\web\View */
/* @var $content string */

use shop\helpers\CategoryHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use shop\helpers\UserHelper;


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
        <header>
            <nav class="navbar navbar-dark">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo" href="<?=Url::home()?>">
                            <img src="<?=Url::base()?>/img/footer_logo.png" alt="logo">
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?=Url::home()?>">Главная</a></li>
                            <li><a href="<?=Url::to(['/course/search/search'])?>">Курсы</a></li>
                            <?php if (UserHelper::isAccessAddCourse()): ?>
                                <li><a href="<?=Url::to(['/course/course/create'])?>">Добавить курс</a></li>
                            <?php endif; ?>
                            <li class="header-favorite-courses"><a href="<?= Url::to(['/cabinet/wishlist/index']) ?>">Избраные</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (Yii::$app->user->isGuest):  ?>
                                <li><a href="#courses-login" class="open-popup-courses-login"><i class="fa fa-sign-in"></i>Вход</a></li>
                                <li><a href="<?=Url::to(['/signup'])?>"><i class="fa fa-user-plus"></i>Регистрация</a></li>
                            <?php  else: ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><?=Yii::$app->user->identity->first_name;?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=Url::to(['/logout'])?>">Log out</a></li>
                                        <li><a href="<?=UserHelper::getCabinetLink();?>">Cabinet</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <div class="header-search">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 header-search-category-wrap">
                        <ul id="main-menu" class="sm sm-vertical sm-clean header-search-field header-search-menu">
                            <li class="category-parent" style="display: none"><a href="#" class="first-line">Категория</a>
                                <ul>
                                    <?= CategoryHelper::CategoriesList(); ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-8 ">
                        <?= Html::beginForm(['/course/search/search'], 'get', ['class' => '']) ?>
                        <div class="row header-wrap-search">
                            <div class="col-sm-12 header-search-field header-search-text">
                                <input type="text" name="text" placeholder="Введите курс, который Вы ищите">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
<!--                            <div class="col-sm-6 header-search-city">-->
<!--                                <div class="header-search-field custom-select">-->
<!--                                    --><?php //= CityHelper::cityList(); ?>
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                        <?= Html::endForm() ?>
                    </div>
                    <div class="col-sm-1 header-search-favorite-courses">
                        <div class="header-search-favorite">
                            <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>
            <div class="container content">
                <?= $content ?>
            </div>

        <footer>
        <div class="container">
            <div class="row">
                <div class="co-md-12">
                    <div class="footer">
                        <div class="footer-logo">
                            <div class="footer-logo-img">
                                <a href="<?=Url::home()?>">
                                    <img src="<?=Url::base()?>/img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <div class="footer-logo-text">
                                &copy; 2018 Teach Me
                            </div>
                        </div>
                        <div class="footer-nav">
                            <ul>
                                <li><a href="<?=Url::home()?>">Главная</a></li>
                                <li><a href="<?=Url::to(['/course/search/search'])?>">Курсы</a></li>
                                <?php if (UserHelper::isAccessAddCourse()): ?>
                                    <li><a href="<?=Url::to(['/course/course/create'])?>">Добавить курс</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <div class="footer-links-email">
                                teachme@gmail.com
                            </div>
                            <div class="footer-links-socs">
                                <a href="#">
                                    <img src="<?=Url::base()?>/img/facebook_icon.png" alt="">
                                </a>
                                <a href="#">
                                    <img src="<?=Url::base()?>/img/instagram_icon.png" alt="">
                                </a>
                                <a href="#">
                                    <img src="<?=Url::base()?>/img/telegram_icon.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


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
