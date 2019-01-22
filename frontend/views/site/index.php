<?php

use shop\helpers\CityHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $categoryViews \shop\readModels\course\views\CategoryView[] */

$this->title = 'Главная';
?>


<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-header-wrap">
                    <h1 class="main-header-title">платформа для поиска курсов</h1>
                    <h3 class="main-header-description">Более 1000 курсов в 100 направлениях, которые можете отфильтровать по цене, типу или по месту расположения</h3>
                    <div class="row main-header-form-wrap">
                        <?= Html::beginForm(['/course/search/search'], 'get'); ?>
                            <div class="col-sm-5 col-sm-offset-1">
                                <div class="buttonInside">
                                    <input type="text" name="text" placeholder="Введите курс, который Вы ищите" class="main-header-form-field">
                                    <button id="showPassword"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-3 header-search-city">
                                <div class="header-search-field custom-select main-select-city">
                                    <?= CityHelper::cityList(); ?>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="main-header-form-field main-form-submit">Найти</button>
                            </div>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="categories-title">
                    <div class="categories-numbers">
                        02
                    </div>
                    <h1 class="categories-title-text">Подбери для себя курс</h1>
                </div>
            </div>
        </div>
        <?php if (!empty($categoryViews)): ?>
            <div class="row category-container">
                <?php foreach ($categoryViews as $categoryView): ?>
                    <div class="col-sm-4 category-item">
                    <a class="c-preview" href="<?= Url::to(['/course/search/search', 'category' => $categoryView->category->id]);?>">
                        <div class="cat-1 c-preview__img" style="background: #000 url(<?= $categoryView->category->getThumbFileUrl('cat_photo', 'thumb') ?: Url::base() . '/img/no_image.png'; ?>) no-repeat center center;background-size: cover"></div>
                        <div class="c-preview__title">
                            <h3 class="c-preview__title"><?=Html::encode($categoryView->category->name);?></h3>
                            <p class="c-preview__count"> курсов (<?=Html::encode($categoryView->count);?>)</p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<div class="main-advantages">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-advantages-wrap">
                    <h1 class="main-header-title main-advantages-title">преимущества платформы</h1>
                    <div class="main-advantages-blocks">
                        <div class="main-advantages-blocks-item">
                            <div class="advantages-icon-wrap">
                                <div class="advantages-icon">
                                    <img src="img/advn_icon_1.png" alt="img">
                                </div>
                            </div>
                            <div class="advantages-text">
                                <p>Сравнивайте и выбирайте лучшее</p>
                            </div>
                        </div>
                        <div class="main-advantages-blocks-item">
                            <div class="advantages-icon-wrap">
                                <div class="advantages-icon">
                                    <img src="img/advn_icon_2.png" alt="img">
                                </div>
                            </div>
                            <div class="advantages-text">
                                <p> Сотни курсов в одном месте</p>
                            </div>
                        </div>
                        <div class="main-advantages-blocks-item">
                            <div class="advantages-icon-wrap">
                                <div class="advantages-icon">
                                    <img src="img/advn_icon_3.png" alt="img">
                                </div>
                            </div>
                            <div class="advantages-text">
                                <p>Читайте и делитись отзывами о курсе</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (Yii::$app->user->isGuest): ?>
    <div class="question">
        <div class="container">
            <div class="row">
                <div class="col-md-12 question-wrap">
                    <h1 class="question-title">Хотите выставить свои курсы на Teach Me ?</h1>
                    <div class="question-btn-wrap">
                        <a href="<?= Url::to(['/signup']) ?>" class="button question-btn">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
