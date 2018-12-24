<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $firm \shop\entities\shop\TeacherMainInfo */
/* @var $searchForm \shop\forms\course\search\SearchForm */
/* @var $loginForm \shop\forms\auth\LoginForm */


use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Html::encode($firm->firm_name);
$this->params['breadcrumbs'][] = $this->title;
?>

<main>
    <div class="container">
        <div class="row">
            <div class="company-info-md">
                <div class="col-lg-3">
                    <div class="course-info">
                        <div class="courser-info-img">
                            <?php if ($firm->firm_photo): ?>
                                <?= Html::img($firm->getThumbFileUrl('firm_photo', 'thumb')); ?>
                            <?php else: ?>
                                <img src="<?= Url::base()?>/img/no_image.png" alt="img">
                            <?php endif; ?>
                            <div class="course-info-socs">
                                <a href="<?= Html::encode($firm->instagram_link); ?>">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="<?= Html::encode($firm->facebook_link); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="<?= Html::encode($firm->vk_link); ?>">
                                    <i class="fa fa-vk"></i>
                                </a>
                                <a href="<?= Html::encode($firm->youtube_link); ?>">
                                    <i class="fa fa-youtube-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($firm->address)): ?>
                                <div class="course-info-address">
                                    <p>
                                        <i class="fa fa-map-marker"></i>
                                        <?= Html::encode($firm->address); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($firm->phone_1)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($firm->phone_1); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($firm->phone_2)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($firm->phone_2); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 search-courses-container">
                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider,
                    'loginForm' => $loginForm
                ]) ?>
            </div>
            <div class="course-info-fixed">
                <div class="col-lg-3">
                    <div class="course-info">
                        <div class="courser-info-img">
                            <?php if ($firm->firm_photo): ?>
                                <?= Html::img($firm->getThumbFileUrl('firm_photo', 'thumb')); ?>
                            <?php else: ?>
                                <img src="<?= Url::base()?>/img/no_image.png" alt="img">
                            <?php endif; ?>
                            <div class="course-info-socs">
                                <a href="<?= Html::encode($firm->instagram_link); ?>">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="<?= Html::encode($firm->facebook_link); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="<?= Html::encode($firm->vk_link); ?>">
                                    <i class="fa fa-vk"></i>
                                </a>
                                <a href="<?= Html::encode($firm->youtube_link); ?>">
                                    <i class="fa fa-youtube-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($firm->address)): ?>
                                <div class="course-info-address">
                                    <p>
                                        <i class="fa fa-map-marker"></i>
                                        <?= Html::encode($firm->address); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($firm->phone_1)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($firm->phone_1); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($firm->phone_2)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($firm->phone_2); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
