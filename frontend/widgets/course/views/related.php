<?php

/** @var $courses \shop\entities\shop\course\Course[]*/

use yii\helpers\Html;
use yii\helpers\Url;
?>




<?php if (!empty($courses)): ?>
    <div class="course-item-box course-related">
        <h3 class="course-item-box-title">Похожие курсы</h3>
        <div class="course-related-carousel">
            <?php foreach ($courses as $course): ?>
            <?php /** @var $course \shop\entities\shop\course\Course; */ ?>
                <div class="course-related-item">
                    <div class="course-related-img">
                        <a href="<?= Url::to(['/course/course/view', 'id' => $course->id]); ?>">
                            <?= Html::img($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>
                        </a>
                    </div>
                    <a href="<?= Url::to(['/course/course/view', 'id' => $course->id]); ?>">
                        <h4 class="course-related-title"><?= Html::encode($course->name); ?></h4>
                    </a>
                    <div class="course-related-address">
                        <p><i class="fa fa-map-marker"></i> <?= Html::encode($course->city->name); ?></p>
                    </div>
                    <div class="course-related-stars">
                        <div class="rating star-icon value-<?= Html::encode(round($course->rating)); ?> color-ok label-left slow">
                            <div class="label-value"><?= Html::encode(round($course->rating, 1)); ?></div>
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
                            <p class="count-comments">(<?= Html::encode($course->getCountsReviews()); ?>)</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="course-relate-price">
                        <p class="current-price"><?= Html::encode($course->price) ?> грн.</p>
                        <p class="old-price">2500 грн.</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
