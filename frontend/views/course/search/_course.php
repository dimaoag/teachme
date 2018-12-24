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
            <img src="<?= Html::encode($course->mainPhoto->getThumbFileUrl('file', 'thumb')) ?>" alt="">
        </a>
        <div class="favorite-img">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php if (!$course->checkInWishlistItems(Yii::$app->user->id)): ?>
                    <a href="<?= Url::to(['/cabinet/wishlist/add'], true)?>" data-id="<?=$course->id?>" class="favorite-toggle hvr-grow" title="в избранное">
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
            <div class="favorite">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php if (!$course->checkInWishlistItems(Yii::$app->user->id)): ?>
                        <a href="<?= Url::to(['/cabinet/wishlist/add'],true)?>" data-id="<?=$course->id?>" class="favorite-toggle hvr-grow" title="в избранное">
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
        <div class="search-course-middle">
            <div class="search-course-date">
                <span><?= Html::encode($course->values[1]['value']); ?></span>
            </div>
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
            </div>
        </div>
        <div class="search-course-footer">
            <div class="search-course-footer-left">
                <p class="master-class"><?= Html::encode($course->courseType->name) ?>:</p>
                <p class="sits"><?= Html::encode($course->values[2]['value']) ?></p>
                <p class="search-course-footer-city">(<?= Html::encode($course->city->name) ?>)</p>
            </div>
            <div class="price">
                <p><?= Html::encode($course->price) ?> грн</p>
            </div>
        </div>
    </div>
</div>



