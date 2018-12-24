<?php
/* @var $this yii\web\View */

/* @var $publications string */
/* @var $course shop\entities\shop\course\Course */
/* @var $courses[] shop\entities\shop\course\Course */


use yii\helpers\Html;
use yii\helpers\Url;
use shop\helpers\CourseHelper;


$this->title = 'Мои курсы';
$this->params['active_course'] = 'active';
?>

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


