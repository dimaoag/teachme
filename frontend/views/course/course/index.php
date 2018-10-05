<?php
/* @var $this yii\web\View */
$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Url;
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="filter-wrap">
                    <div class="filter filter-bordered">
                        <a href="#filter1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                            <h4>Тип обучения</h4>
                            <i class="toggle fa fa-plus" style="display: none"></i>
                            <i class="toggle fa fa-minus"></i>
                        </a>
                        <ul class="collapse list-unstyled collapse in" id="filter1">
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx" class="label-cbx">
                                            <input id="cbx" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>любой</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx1" class="label-cbx">
                                            <input id="cbx1" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>курс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx2" class="label-cbx">
                                            <input id="cbx2" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>мастеркласс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx3" class="label-cbx">
                                            <input id="cbx3" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>вебинар</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="filter">
                        <a href="#filter2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                            <h4>Формат</h4>
                            <i class="toggle fa fa-plus" style="display: none"></i>
                            <i class="toggle fa fa-minus"></i>
                        </a>
                        <ul class="collapse list-unstyled collapse in" id="filter2">
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx4" class="label-cbx">
                                            <input id="cbx4" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>любой</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx5" class="label-cbx">
                                            <input id="cbx5" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>курс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx6" class="label-cbx">
                                            <input id="cbx6" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>мастеркласс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx7" class="label-cbx">
                                            <input id="cbx7" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>вебинар</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="filter">
                        <a href="#filter3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                            <h4>Группа</h4>
                            <i class="toggle fa fa-plus" style="display: none"></i>
                            <i class="toggle fa fa-minus"></i>
                        </a>
                        <ul class="collapse list-unstyled collapse in" id="filter3">
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx8" class="label-cbx">
                                            <input id="cbx8" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>любой</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx9" class="label-cbx">
                                            <input id="cbx9" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>курс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx10" class="label-cbx">
                                            <input id="cbx10" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>мастеркласс</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="checkboxes">
                                    <div class="cntr">
                                        <label for="cbx11" class="label-cbx">
                                            <input id="cbx11" type="checkbox" class="invisible">
                                            <div class="checkbox">
                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                </svg>
                                            </div>
                                            <span>вебинар</span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="filter">
                        <h4>Цена</h4>
                        <div class="checkboxes">
                            <!--<input type="hidden" id="hidden_minimum_price" value="0">-->
                            <!--<input type="hidden" id="hidden_maximum_price" value="10000">-->
                            <!--<p id="price_show">1000 - 10000 грн</p>-->
                            <!--<div id="price_range"></div>-->

                            <!--<p id="amount"></p>-->
                            <!--<div id="slider-range" class="price-range" style="margin: 25px 0;"></div>-->
                            <!--<input type="hidden" id="min_price">-->
                            <!--<input type="hidden" id="max_price">-->
                            <div class="price_my_range" id="price_my_range">
                            </div>
                            <div class="range-inputs">
                                <p>от</p>
                                <input type="number" id="min_price">
                                <p>до</p>
                                <input type="number" id="max_price" min="1" value="1">
                                <p>грн.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 search-courses-container">
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-course">
                    <div class="search-course-img">
                        <a href="#">
                            <img src="<?=Url::base()?>/img/search_course.png" alt="">
                        </a>
                        <div class="favorite-img">
                            <a href="#" class="favorite-toggle hvr-grow">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="search-course-info">
                        <div class="search-course-header">
                            <h4><a href="#">Курс аппаратного маникю  оффлайн для начинающих</a></h4>
                            <div class="favorite">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                <p>в избранное</p>
                            </div>
                        </div>
                        <div class="search-course-middle">
                            <div class="search-course-date">
                                <span>оффлайн</span>
                            </div>
                            <div class="rating star-icon value-3 color-ok label-left slow">
                                <div class="label-value">3.1</div>
                                <div class="star-container">
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                    <div class="star">
                                        <i class="star-empty"></i>
                                        <i class="star-half"></i>
                                        <i class="star-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-course-footer">
                            <div class="search-course-footer-left">
                                <p class="master-class">Мастер-класс:</p>
                                <p class="sits">до 3 учеников</p>
                                <p class="search-course-footer-city">(Винница)</p>
                            </div>
                            <div class="price">
                                <p>2500 грн</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>