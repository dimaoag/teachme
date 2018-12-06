<?php
/* @var $this yii\web\View */

/* @var $publications string */
/* @var $course shop\entities\shop\course\Course */
/* @var $courses[] shop\entities\shop\course\Course */

use shop\entities\shop\course\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\helpers\CourseHelper;
?>
<main>
    <div class="container">
        <div class="row cabinet-company">
            <div class="col-md-3 tab-labels">
                <label class="tab-company active" title="Мои курсы"><span class="tab-company-text">Мои курсы</span><span class="tab-company-icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span></label>
                <label class="tab-company" title="Заявки"><span class="tab-company-text">Заявки</span><span class="tab-company-icon"><i class="fa fa-list" aria-hidden="true"></i></span></label>
                <label class="tab-company" title="Основная информация"><span class="tab-company-text">Основная информация</span><span class="tab-company-icon"><i class="fa fa-address-card" aria-hidden="true"></i></span></label>
                <label class="tab-company" title="Услуги и платежи"><span class="tab-company-text">Услуги и платежи</span><span class="tab-company-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span></label>
                <label class="tab-company" title="Настройки"><span class="tab-company-text">Настройки</span><span class="tab-company-icon"><i class="fa fa-cogs" aria-hidden="true"></i></span></label>
                <label class="tab-company" title="Тех поддержка"><span class="tab-company-text">Тех поддержка</span><span class="tab-company-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
            </div>
            <div class="col-md-9">
                <div class="tab-cabinet-container tab-courses active">
                    <div class="tab-my-courses">
                        <div class="my-courses-header">
                            <p>Количество публиций: <span><?=$publications?></span></p>
                            <a href="<?=Url::to(['/course/create'])?>" class="button hvr-grow">Добавить курс</a>
                        </div>
                        <div class="my-courses-wrap">
                            <?php if (!empty($courses)): ?>
                                <?php foreach ($courses as $course): ?>
                                    <div class="search-course">
                                        <div class="search-course-img cabinet-course-img">
                                            <a href="<?= Url::to(['/course/course/view', 'id' => $course->id])?>">
                                                <img src="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="search-course-info">
                                            <div class="search-course-header">
                                                <h4>
                                                    <a href="<?= Url::to(['/course/course/view', 'id' => $course->id])?>"><?= Html::encode($course->name); ?></a>
                                                </h4>
                                                <div class="course-orders">
                                                    <span>25</span>
                                                    <p>заявок</p>
                                                </div>
                                            </div>
                                            <div class="course-status">
                                                <div class="course-status-name">
                                                    Статус
                                                </div>
                                                <div class="course-status-value">
                                                    <?= CourseHelper::getStatus($course);?>
                                                </div>
                                            </div>
                                            <div class="course-control">
                                                <div class="left">
                                                    <a href="<?= Url::to(['/course/course/update', 'id' => $course->id])?>" class="edit">Редактировать</a>
<!--                                                    <a href="#" class="remove">Деактивировать</a>-->
                                                </div>
                                                <div class="right">
                                                    <?= CourseHelper::getStatusLink($course->status, $course->id);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;  ?>
                            <?php else: ?>
                                <p class="text-center"> Список курсов пуст</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-cabinet-container tab-orders">
                    <div class="orders-header">
                        <select name="status" class="orders-select">
                            <option value="1" selected>Все курсы</option>
                            <option value="2">Курс 1</option>
                            <option value="3">Курс 2</option>
                            <option value="4">Курс 3</option>
                        </select>
                        <a href="#" class="archive">Перейти к архиву <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-12 orders-container orders-static">
                            <div class="col-md-4">
                                <h3>Новые заявки</h3>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>В обработке</h3>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Обработаные</h3>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-item">
                                    <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name">Сергей</p>
                                            <p class="date">20.09.18</p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name">Заявка as TM</p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price">2500 грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 orders-container orders-slide">
                            <div class="owl-carousel">
                                <div class="col-md-4">
                                    <h3>Новые заявки</h3>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h3>В обработке</h3>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h3>Обработаные</h3>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="order-item">
                                        <a href="mobile-friendly-page.html" data-mfp-src="#order_popup" class="open-order-popup">
                                            <div class="order-item-header">
                                                <p class="name">Сергей</p>
                                                <p class="date">20.09.18</p>
                                            </div>
                                            <div class="order-item-center">
                                                <p class="course-name">Заявка as TM</p>
                                            </div>
                                        </a>
                                        <div class="order-item-bottom">
                                            <p class="order-item-bottom-price">2500 грн.</p>
                                            <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <!--modals-->
                        <div id="order_popup" class="white-popup mfp-hide order_popup">
                            <div class="row order-popup-wrap">
                                <div class="col-sm-4">
                                    <form action="#">
                                        <div class="order-info-wrap">
                                            <div class="row popup-order-info">
                                                <div class="col-xs-4">
                                                    <p class="popup-order-name popup-order-status">Статус</p>
                                                </div>
                                                <div class="col-xs-8 header-search-city">
                                                    <div class="custom-select main-select-city order-popup-select">
                                                        <select name="status" class="orders-select" id="status">
                                                            <option value="1" selected>Новая заявка</option>
                                                            <option value="2">В обработке</option>
                                                            <option value="3">Обработаная</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row popup-order-info">
                                                <div class="col-xs-4">
                                                    <p class="popup-order-name">Цена</p>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p class="popup-order-value">2500 грн.</p>
                                                </div>
                                            </div>
                                            <div class="row popup-order-info">
                                                <div class="col-xs-4">
                                                    <p class="popup-order-name">Имя</p>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p class="popup-order-value">Сергей</p>
                                                </div>
                                            </div>
                                            <div class="row popup-order-info">
                                                <div class="col-xs-4">
                                                    <p class="popup-order-name">Телефон</p>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p class="popup-order-value">+380939179871</p>
                                                </div>
                                            </div>
                                            <div class="row popup-order-info">
                                                <div class="col-xs-4">
                                                    <p class="popup-order-name">Курс</p>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p class="popup-order-value">Начинающие курсы английського языка</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn btn-block button-pure">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-8 popup-order-comments">
                                    <div class="comment-container">
                                        <div class="comment">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto debitis ea et eveniet hic magnam quam, soluta voluptas voluptatum!</p>
                                        </div>
                                        <div class="comment">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto debitis ea et eveniet hic magnam quam, soluta voluptas voluptatum!</p>
                                        </div>
                                        <div class="comment">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto debitis ea et eveniet hic magnam quam, soluta voluptas voluptatum!</p>
                                        </div>
                                    </div>
                                    <form action="#" class="popup-order-form">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <textarea class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 float-r">
                                                <button type="submit" class="btn btn-block btn-default popup-comment-btn">Добавить комментарий</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-cabinet-container tab-main-info">
                    <h2 class="tab-main-info-title">Добавьте основную информацию по организации</h2>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="#">
                                <div class="add-photo-profile">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>Выберите изображения организации</h4>
                                                <div class="row">
                                                    <div id="photo_profile_company"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 main-form-field-item">
                                            <label for="name">Название организации</label>
                                            <input type="text" class="form-control" id="name" placeholder="Названия">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 main-form-field-item header-search-city">
                                            <label for="region">Регион</label>
                                            <div class="add-course-select">
                                                <div class="custom-select main-select-city">
                                                    <select class="form-control" name="region" id="region">
                                                        <option value="0">Выберите город</option>
                                                        <option value="1">Киев</option>
                                                        <option value="2">Винница</option>
                                                        <option value="3">Одесса</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 main-form-field-item">
                                            <label for="address">Адрес</label>
                                            <div class="main-info-form-field">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <input type="text" class="form-control" id="address" placeholder="Названия">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-5 main-form-field-item">
                                            <div class="main-info-form-field main-info-field-phone">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <input type="text" class="form-control" data-mask="callback-catalog-phone" value="979746559" name="phone_1" placeholder="+38 ( ___ ) - ____ - __ - __">
                                            </div>
                                            <div class="main-info-form-field main-info-field-phone">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <input type="text" class="form-control" name="phone_2" data-mask="callback-catalog-phone" placeholder="+38 ( ___ ) - ____ - __ - __">
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
                                                <input type="text" class="form-control" name="link_instagram">
                                            </div>
                                            <div class="main-info-form-field main-info-field-socs facebook-field">
                                                <i class="fa fa-facebook"></i>
                                                <input type="text" class="form-control" name="link_facebook">
                                            </div>
                                            <div class="main-info-form-field main-info-field-socs vk-field">
                                                <i class="fa fa-vk"></i>
                                                <input type="text" class="form-control" name="link_vk">
                                            </div>
                                            <div class="main-info-form-field main-info-field-socs youtube-field">
                                                <i class="fa fa-youtube-play"></i>
                                                <input type="text" class="form-control" name="link_youtube">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 float-r">
                                    <button type="submit" class="btn btn-block button-pure">Сохранить данные</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-cabinet-container tab-price">
                    <h2>Услуги для бизнеса</h2>
                    <p class="tab-price-my-quantity">В наличии 3 публикации</p>
                    <div class="row">
                        <div class="col-md-10">
                            <form class="form-price">
                                <div class="form-price-item first-block">
                                    <p>1 публикация</p>
                                    <small>249 грн / шт.</small>
                                </div>
                                <div class="form-price-item second-block">
                                    <p>250 грн</p>
                                </div>
                                <div class="form-price-item third-block header-search-city">
                                    <p>Количество</p>
                                    <div class="custom-select main-select-city price-select">
                                        <select name="quantity">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-price-item fourth-block">
                                    <button type="submit" class="btn btn-block button-pure">Купить</button>
                                </div>
                            </form>
                            <form class="form-price top-price">
                                <div class="form-price-item first-block">
                                    <p>3 публикации</p>
                                    <small>166 грн / шт.</small>
                                </div>
                                <div class="form-price-item second-block">
                                    <p>499 грн</p>
                                    <s><small>750 грн грн</small></s>
                                </div>
                                <div class="form-price-item third-block header-search-city">
                                    <p>Количество</p>
                                    <div class="custom-select main-select-city price-select">
                                        <select name="quantity">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-price-item fourth-block">
                                    <button type="submit" class="btn btn-block button-pure">Купить</button>
                                </div>
                            </form>
                            <form class="form-price">
                                <div class="form-price-item first-block">
                                    <p>5 публикаций</p>
                                    <small>150 грн / шт.</small>
                                </div>
                                <div class="form-price-item second-block">
                                    <p>750 грн</p>
                                    <s><small>1250 грн грн</small></s>
                                </div>
                                <div class="form-price-item third-block header-search-city">
                                    <p>Количество</p>
                                    <div class="custom-select main-select-city price-select">
                                        <select name="quantity">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-price-item fourth-block">
                                    <button type="submit" class="btn btn-block button-pure">Купить</button>
                                </div>
                            </form>
                            <form class="form-price">
                                <div class="form-price-item first-block">
                                    <p>10 публикаций</p>
                                    <small>125 грн / шт.</small>
                                </div>
                                <div class="form-price-item second-block">
                                    <p>1250 грн</p>
                                    <s><small>2500 грн грн</small></s>
                                </div>
                                <div class="form-price-item third-block header-search-city">
                                    <p>Количество</p>
                                    <div class="custom-select main-select-city price-select">
                                        <select name="quantity">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-price-item fourth-block">
                                    <button type="submit" class="btn btn-block button-pure">Купить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-cabinet-container tab-setting">
                    <h2>Личная информация</h2>
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-horizontal form-item">
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-3 control-label">Имя</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Имя">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-3 control-label">Фамилия</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="last_name" id="last_name" placeholder="Фамилия">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить данные</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal form-item">
                                <div class="form-group">
                                    <label for="phone" class="col-sm-3 control-label">Телефон</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить телефон</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal form-item">
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить email</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal form-item">
                                <div class="form-group">
                                    <label for="old_password" class="col-sm-3 control-label">Старый пароль</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="old_password" id="old_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password" class="col-sm-3 control-label">Новый пароль</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="new_password" id="new_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password" class="col-sm-3 control-label">Подтвердить пароль</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить пароль</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-cabinet-container tab-feedback">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="feedback-title">Служба поддержки</h2>
                        <form role="form">
                            <div class="form-group">
                                <label for="message">Сообщение</label>
                                <textarea class="form-control" rows="7" name="message" id="message" placeholder="Введите текст"></textarea>
                            </div>
                            <button type="submit" class="btn btn-block button-pure">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>