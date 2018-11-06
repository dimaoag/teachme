<?php
/* @var $this yii\web\View */
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
                        <form action="#">
                            <div class="col-sm-5 col-sm-offset-1">
                                <form action="#">
                                    <div class="buttonInside">
                                        <input type="text" name="s" placeholder="Введите курс, который Вы ищите" class="main-header-form-field">
                                        <button id="showPassword"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 header-search-city">
                                <div class="header-search-field custom-select main-select-city">
                                    <select name='category'>
                                        <option value='1'>Винница</option>
                                        <option value='2'>Киев</option>
                                        <option value='3'>Одесса</option>
                                        <option value='4'>Львов</option>
                                        <option value='4'>Днепр</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="main-header-form-field main-form-submit hvr-grow">Найти</button>
                            </div>
                        </form>
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
        <div class="row category-container">
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-1 c-preview__img" style="background: #000 url(img/1.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Программирование</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-2 c-preview__img" style="background: #000 url(img/2.png) no-repeat center center; background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Дизайн</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-3 c-preview__img" style="background: #000 url(img/3.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Иностранные языки</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-4 c-preview__img" style="background: #000 url(img/4.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Автошколы</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-5 c-preview__img" style="background: #000 url(img/5.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Кулинария</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-6 c-preview__img" style="background: #000 url(img/6.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Творчество</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-7 c-preview__img" style="background: #000 url(img/7.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Профессиональные курсы</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-8 c-preview__img" style="background: #000 url(img/8.png) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Красота и стиль</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 category-item">
                <a class="c-preview" href="#">
                    <div class="cat-9 c-preview__img" style="background: #000 url(img/9.jpg) no-repeat center center;background-size: cover"></div>
                    <div class="c-preview__title">
                        <h3 class="c-preview__title">Здоровье и спорт</h3>
                        <p class="c-preview__title">132 курса</p>
                    </div>
                </a>
            </div>
        </div>
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

<div class="question">
    <div class="container">
        <div class="row">
            <div class="col-md-12 question-wrap">
                <h1 class="question-title">Хотите выставить свои курсы на Teach Me ?</h1>
                <div class="question-btn-wrap">
                    <a href="#" class="button question-btn">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
</div>
