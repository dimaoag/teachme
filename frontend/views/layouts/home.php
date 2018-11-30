<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use shop\helpers\UserHelper;

AppAsset::register($this);
FontAwesomeAsset::register($this);
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
    <div class="wrapper">
    <?php $this->beginBody() ?>
        <header>
            <nav class="navbar navbar-default navbar-main-page">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo" href="<?=Url::home()?>">
                            <img src="<?=Url::base()?>/img/logo.png" alt="logo">
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?=Url::home()?>">Главная</a></li>
                            <li><a href="<?=Url::to(['/course'])?>">Курсы</a></li>
                            <?php if (UserHelper::isAccessAddCourse()): ?>
                                <li><a href="<?=Url::to(['/course/course/create'])?>">Добавить курс</a></li>
                            <?php endif; ?>
                            <li class="header-favorite-courses"><a href="#">Избраные</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?=Url::to(['/login'])?>"><i class="fa fa-sign-in"></i>Вход</a></li>
                                <li><a href="<?=Url::to(['/signup'])?>"><i class="fa fa-user-plus"></i>Регистрация</a></li>
                            <?php  else: ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><?=Yii::$app->user->identity->first_name;?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=Url::to(['/logout'])?>">Log out</a></li>
                                        <li><a href="<?=Url::to(['/cabinet'])?>">Cabinet</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <?= Alert::widget() ?>
        <div class="content">
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
                                <li><a href="<?=Url::to(['/course'])?>">Курсы</a></li>
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
    <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>
