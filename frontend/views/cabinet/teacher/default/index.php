<?php
/* @var $this yii\web\View */

/* @var $publications string */
/* @var $course shop\entities\shop\course\Course */
/* @var $courses[] shop\entities\shop\course\Course */
/* @var $teacherMainInfoForm \shop\forms\manage\shop\TeacherMainInfoForm */
/* @var $teacherMainInfo \shop\entities\shop\TeacherMainInfo*/
/* @var $profileEditForm \shop\forms\manage\user\ProfileEditForm*/
/* @var $profileEditPasswordForm \shop\forms\manage\user\ProfileEditPasswordForm*/

use shop\entities\shop\course\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\helpers\CourseHelper;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;


$this->title = 'Кабинет пользователя';
?>
<main>
    <div class="container">
        <div class="row cabinet-company">
            <div class="col-md-3 tab-labels">
                <label class="tab-company active" title="Мои курсы">
                    <span class="tab-company-text">Мои курсы</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </span>
                </label>
                <label class="tab-company" title="Заявки">
                    <span class="tab-company-text">Заявки</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                    </span>
                </label>
                <label class="tab-company" title="Основная информация">
                    <span class="tab-company-text">Основная информация</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
                </label>
                <label class="tab-company" title="Услуги и платежи">
                    <span class="tab-company-text">Услуги и платежи</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </span>
                </label>
                <label class="tab-company" title="Настройки">
                    <span class="tab-company-text">Настройки</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                    </span>
                </label>
                <label class="tab-company" title="Тех поддержка">
                    <span class="tab-company-text">Тех поддержка</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </span>
                </label>
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
                                                <?php if (!empty($course->mainPhoto)): ?>
                                                    <img src="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>" alt="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>">
                                                <?php else: ?>
                                                    <img src="/img/no_image.png" alt="img">
                                                <?php endif; ?>
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
                                            <?= $form->field($teacherMainInfoForm, 'city_id')->dropDownList($teacherMainInfoForm->getCitiesList(), ['id' => 'city_id', 'prompt' => 'Выберите город...']); ?>
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
                                                <?= $form->field($teacherMainInfoForm, 'phone_1')->textInput(['maxlength' => true, 'data-mask' => 'callback-catalog-phone']); ?>
                                            </div>
                                            <div class="main-info-form-field main-info-field-phone">
                                                <?= $form->field($teacherMainInfoForm, 'phone_2')->textInput(['maxlength' => true, 'data-mask' => 'callback-catalog-phone']); ?>
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
                                            <div class="main-info-form-field main-info-field-socs vk-field">
                                                <i class="fa fa-vk"></i>
                                                <?= $form->field($teacherMainInfoForm, 'vk_link')->textInput()->label(false); ?>
                                            </div>
                                            <div class="main-info-form-field main-info-field-socs youtube-field">
                                                <i class="fa fa-youtube-play"></i>
                                                <?= $form->field($teacherMainInfoForm, 'youtube_link')->textInput()->label(false); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 float-r">
                                    <button type="submit" class="btn btn-block button-pure">Сохранить данные</button>
                                </div>
                            <?php ActiveForm::end(); ?>
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
                        <div class="col-md-9">
                            <?php $form = ActiveForm::begin(['id' => 'profileEditForm']); ?>
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label">Имя</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditForm, 'first_name')->textInput(['id' => 'first_name', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-4 control-label">Фамилия</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditForm, 'last_name')->textInput(['id' => 'last_name', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-4 control-label">Телефон</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditForm, 'phone')->textInput(['id' => 'phone', 'maxlength' => true, 'data-mask' => 'callback-catalog-phone'])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditForm, 'email')->textInput(['id' => 'email', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить данные</button>
                                        <br>
                                    </div>
                                </div>
                            <?php $form = ActiveForm::end(); ?>
                            <br>
                            <?php $form = ActiveForm::begin(['id' => 'profileEditPasswordForm']); ?>
                                <div class="form-group">
                                    <label for="oldPassword" class="col-sm-4 control-label">Старый пароль</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditPasswordForm, 'oldPassword')->passwordInput(['id' => 'oldPassword', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password1" class="col-sm-4 control-label">Новый пароль</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditPasswordForm, 'password1')->passwordInput(['id' => 'password1', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password2" class="col-sm-4 control-label">Подтвердить пароль</label>
                                    <div class="col-sm-8">
                                        <?= $form->field($profileEditPasswordForm, 'password2')->passwordInput(['id' => 'password2', 'maxlength' => true])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-block button-pure tab-setting-btn">Изменить пароль</button>
                                    </div>
                                </div>
                            <?php $form = ActiveForm::end(); ?>
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