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
            <img src="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')) ?>" alt="image">
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
                <a href="#courses-login" class="open-popup-courses-login hvr-grow" title="в избранное">
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
                <a href="#courses-login" class="open-popup-courses-login favorite-icon-lg hvr-grow" title="в избранное">
                    <i class="fa fa-heart-o"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="search-course-middle">
            <div class="rating star-icon value-<?= Html::encode(round($course->rating)) ?> color-ok label-left slow">
                <div class="label-value"><?= Html::encode($course->rating) ?></div>
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
                <div class="count-comments">(75)</div>
            </div>
        </div>
        <div class="search-course-footer">
            <div class="search-course-footer-left">
                <p class="master-class"><?= Html::encode($course->courseType->name) ?></p>
<!--                <p class="master-class">курс</p>-->
                <p class="search-course-footer-city">(<?= Html::encode($course->city->name) ?>)</p>
            </div>
            <div class="price">
                <div class="sm-course-rating">
                    <span><?= Html::encode($course->rating) ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                    <svg class="star-hide" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                    <svg class="star-hide" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                    <svg class="star-hide" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                    <svg class="star-hide" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="268ea" d="M527.651 290.384l1.962 3.776 4.387.606-3.175 2.939.75 4.15-3.924-1.96-3.924 1.96.75-4.15-3.175-2.94 4.387-.605z"/></defs><g><g transform="translate(-521 -290)"><use fill="#efce4a" xlink:href="#268ea"/></g></g></svg>
                </div>
                <p class="old-price">3500 грн</p>
                <p class="current-price"><?= Html::encode($course->price) ?> грн</p>
            </div>
        </div>
    </div>
</div>



