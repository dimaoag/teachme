<?php

/* @var $this yii\web\View */
/* @var $course shop\entities\shop\course\Course */


use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['/course/course/view', 'id' =>$course->id]);

use frontend\assets\AppAsset;
AppAsset::register($this);
?>



<div class="search-course">
    <div class="search-course-img">
        <a href="<?= Html::encode($url) ?>">
            <?php if (!empty($course->mainPhoto)): ?>
                <img src="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>" alt="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>">
            <?php else: ?>
                <img src="<?= Url::base(); ?>/img/no_image.png" alt="img">
            <?php endif; ?>
        </a>
        <div class="favorite-img">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php if (!$course->checkInWishlistItems(Yii::$app->user->id)): ?>
                    <a href="<?= Url::to(['/cabinet/wishlist/add'], true)?>" data-id="<?=$course->id?>" class="favorite-toggle hvr-grow" title="в избраное">
                        <i class="fa fa-heart-o"></i>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/cabinet/wishlist/delete-ajax'], true) ?>" data-id="<?=$course->id?>" class="favorite-toggle hvr-grow" title="удалить из избранных">
                        <i class="fa fa-heart"></i>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="#courses-login" class="open-popup-courses-login favorite-course-disable hvr-grow" title="в избранное">
                    <i class="fa fa-heart-o"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="search-course-info">
        <div class="search-course-header">
            <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($course->name) ?></a></h4>

            <?php if (!Yii::$app->user->isGuest): ?>
                <?php if (!$course->checkInWishlistItems(Yii::$app->user->id)): ?>
                    <a href="<?= Url::to(['/cabinet/wishlist/add'], true)?>" data-id="<?=$course->id?>" class="favorite-toggle favorite-icon-lg hvr-grow" title="в избранное">
                        <i class="fa fa-heart-o"></i>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/cabinet/wishlist/delete-ajax'], true) ?>" data-id="<?=$course->id?>" class="favorite-toggle favorite-icon-lg hvr-grow" title="удалить из избранных">
                        <i class="fa fa-heart"></i>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="#courses-login" class="open-popup-courses-login favorite-course-disable favorite-icon-lg hvr-grow" title="в избранное">
                    <i class="fa fa-heart-o"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="search-course-middle">
            <div class="rating star-icon value-<?= Html::encode(round($course->rating ?: 0)) ?> color-ok label-left slow">
                <div class="label-value"><?= Html::encode($course->rating ?: 0) ?></div>
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
                <div class="count-comments">(<?= Html::encode($course->getCountsReviews()); ?>)</div>
            </div>
        </div>
        <div class="search-course-footer">
            <div class="search-course-footer-left">
                <p class="master-class"><?= Html::encode($course->values[0]->value) ?></p>
                <p class="master-class"><?= Html::encode($course->courseType->name) ?></p>
                <p class="search-course-footer-city">(<?= Html::encode($course->city->name) ?>)</p>
            </div>
            <div class="price">
                <div class="sm-course-rating">
                    <div class="sm-course-rating-one-star">
                        <span ><?= Html::encode($course->rating ?: 0) ?></span>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                    </div>
                    <div class="rating star-icon value-<?= Html::encode(round($course->rating ?: 0)) ?> color-ok label-left slow sm-course-rating-stars">
                        <div class="label-value"><?= Html::encode($course->rating ?: 0) ?></div>
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
                <?php if ($course->old_price): ?>
                    <p class="old-price"><?= Html::encode($course->old_price) ?> грн</p>
                <?php endif; ?>
                <p class="current-price"><?= Html::encode($course->price) ?> грн</p>
            </div>
        </div>
    </div>
</div>



