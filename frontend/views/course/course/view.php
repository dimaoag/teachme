<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\course\RelatedCoursesWidget;
use shop\helpers\CourseHelper;

/* @var $course shop\entities\shop\course\Course */
/* @var $reviewForm \shop\forms\course\ReviewForm*/
/* @var $orderCreateForm \shop\forms\course\order\OrderCreateForm*/
/* @var $review \shop\entities\shop\course\Review*/
/* @var $loginForm \shop\forms\auth\LoginForm*/



$this->title = $course->name;

foreach ($course->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['/course/search/search', 'category' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $course->category->name, 'url' => ['/course/search/search', 'category' => $course->category->id]];
$this->params['breadcrumbs'][] = $course->name;

?>


<div class="container course-wrap">
    <div class="row">
        <div class="course-info-small">
            <div class="col-lg-3">
                <div class="course-info">
                    <div class="courser-info-img">
                        <?php if (!empty($course->mainPhoto)): ?>
                            <?= Html::img($course->mainPhoto->getThumbFileUrl('file', 'thumb'),['alt' => 'image_course']); ?>
                        <?php else: ?>
                            <img src="<?=Url::base()?>/img/no_image.png" alt="img">
                        <?php endif; ?>
                        <div class="favorite-course-top">
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
                                <a href="#courses-login" class="open-popup-courses-login favorite-course-disable favorite-icon-lg hvr-grow" title="в избранное">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="course-info-item course-info-title">
                        <a href="<?= Url::to(['/course/course/firm', 'id' => $course->firm->id]); ?>"><?= Html::encode($course->firm->firm_name); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7" height="12" viewBox="0 0 7 12"><defs><path id="zll9a" d="M1398.508 336.815a.371.371 0 0 0 0 .56l5.448 4.93-5.448 4.939a.371.371 0 0 0 0 .56.47.47 0 0 0 .619 0l5.746-5.21a.37.37 0 0 0 0-.56l-5.746-5.21a.46.46 0 0 0-.619-.009z"/></defs><g><g transform="translate(-1398 -336)"><use fill="#0a0a0a" xlink:href="#zll9a"/></g></g></svg>
                        </a>
                    </div>
                    <div class="course-info-location">
                        <?php if (!empty($course->firm->address)): ?>
                            <div class="course-info-item course-info-address">
                                <p><i class="fa fa-map-marker"></i> <?= Html::encode($course->firm->address); ?></p>
                            </div>
                        <?php endif;?>
                        <?php if (!empty($course->firm->phone_1)): ?>
                            <div class="course-info-item course-info-phone">
                                <p><i class="fa fa-phone"></i> <?= Html::encode($course->firm->phone_1); ?></p>
                            </div>
                        <?php endif;?>
                        <?php if (!empty($course->firm->phone_2)): ?>
                            <div class="course-info-item course-info-phone">
                                <p><i class="fa fa-phone"></i> <?= Html::encode($course->firm->phone_2); ?></p>
                            </div>
                        <?php endif;?>
                        <div class="course-info-item course-info-socs">
                            <?php if (!empty($course->firm->instagram_link)): ?>
                                <a href="<?= Html::encode($course->firm->instagram_link); ?>" title="instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="gva2a" d="M1282 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1282 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1272 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1282 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1292 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="gva2b" d="M1287.181 493.332c0 1.02-.83 1.85-1.849 1.85h-6.664c-1.02 0-1.85-.83-1.85-1.85v-6.664c0-1.02.83-1.85 1.85-1.85h6.664c1.02 0 1.85.83 1.85 1.85v6.664zm-1.849-9.1h-6.664a2.439 2.439 0 0 0-2.436 2.436v6.664a2.439 2.439 0 0 0 2.436 2.436h6.664a2.439 2.439 0 0 0 2.436-2.436v-6.664a2.439 2.439 0 0 0-2.436-2.436z"/><path id="gva2c" d="M1285.026 489.827a3.039 3.039 0 0 0-2.887-2.855 3.034 3.034 0 0 0-3.166 3.17 3.039 3.039 0 0 0 2.856 2.884 3.013 3.013 0 0 0 1.77-.453.29.29 0 0 0 .053-.452l-.005-.004a.292.292 0 0 0-.361-.04c-.381.237-.83.372-1.312.367a2.454 2.454 0 0 1-2.417-2.514 2.447 2.447 0 0 1 2.6-2.37 2.45 2.45 0 0 1 2.279 2.235c.04.488-.065.95-.276 1.348a.292.292 0 0 0 .049.344l.004.004a.29.29 0 0 0 .46-.065c.253-.473.385-1.02.353-1.6z"/><path id="gva2d" d="M1284.608 486.186a.782.782 0 1 1 1.565 0 .782.782 0 0 1-1.565 0z"/></defs><g><g transform="translate(-1272 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#gva2a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2c"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2d"/></g></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->facebook_link)): ?>
                                <a href="<?= Html::encode($course->firm->facebook_link); ?>" title="facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="51c1a" d="M1318.071 482.929A9.934 9.934 0 0 0 1311 480a9.989 9.989 0 0 0-7.071 2.929A9.935 9.935 0 0 0 1301 490c0 2.082.634 4.078 1.833 5.772a9.978 9.978 0 0 0 4.689 3.606.316.316 0 0 0 .425-.305v-5.705a.316.316 0 0 0-.315-.315H1305v-2.316h2.632a.316.316 0 0 0 .315-.316V490c0-2.748 2.607-5.158 5.58-5.158h1.368v2.316h-1.369c-.89 0-1.701.256-2.281.722-.642.515-.982 1.248-.982 2.12v.421c0 .174.142.316.316.316h1.245a.316.316 0 0 0 0-.632h-.93V490c0-1.632 1.418-2.21 2.632-2.21h1.684a.316.316 0 0 0 .316-.316v-2.948a.316.316 0 0 0-.316-.315h-1.684c-1.543 0-3.108.614-4.293 1.684-1.236 1.118-1.917 2.576-1.917 4.105v.105h-2.632a.316.316 0 0 0-.316.316v2.947c0 .175.142.316.316.316h2.632v4.932a9.413 9.413 0 0 1-5.684-8.616c0-5.166 4.202-9.368 9.368-9.368 5.16 0 9.368 4.208 9.368 9.368 0 5.166-4.202 9.368-9.368 9.368h-.105v-5.684h4.315a.316.316 0 0 0 .316-.316v-2.947a.316.316 0 0 0-.316-.316h-1.848a.316.316 0 0 0 0 .632h1.533v2.316h-4.316a.316.316 0 0 0-.316.315v6.307c0 .168.133.308.302.315a9.934 9.934 0 0 0 7.506-2.919A9.989 9.989 0 0 0 1321 490a9.935 9.935 0 0 0-2.929-7.071z"/></defs><g><g transform="translate(-1301 -480)"><g><g><use fill="#9e3ffc" xlink:href="#51c1a"/></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->vk_link)): ?>
                                <a href="<?= Html::encode($course->firm->vk_link); ?>" title="telegram">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="uqp5a" d="M1340 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1340 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1330 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1340 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1350 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="uqp5b" d="M1344.794 484.007a.307.307 0 0 0-.326-.027l-11.876 6.142a.307.307 0 0 0 .004.548l3.106 1.553v3.077a.308.308 0 0 0 .456.277l3.554-1.974 2.72 1.166a.308.308 0 0 0 .43-.219l.689-3.44a.307.307 0 0 0-.603-.121l-.614 3.07-2.518-1.08a.307.307 0 0 0-.27.014l-3.23 1.794v-2.754a.307.307 0 0 0-.17-.275l-2.735-1.368 10.771-5.571-.935 4.674a.307.307 0 0 0 .603.12l1.06-5.3a.307.307 0 0 0-.116-.306z"/><path id="uqp5c" d="M1338.989 490.602a.307.307 0 0 0-.058.08l-.646 1.293v-1.803l2.949-1.815zm4.553-4.068a.307.307 0 0 0-.402-.072l-5.324 3.276a.307.307 0 0 0-.146.262v3.276a.307.307 0 0 0 .582.137l1.206-2.412 4.06-4.06c.11-.11.12-.285.024-.407z"/></defs><g><g transform="translate(-1330 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5c"/></g></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->youtube_link)): ?>
                                <a href="<?= Html::encode($course->firm->youtube_link); ?>" title="youtube">
                                <svg id="youtube_2_" data-name="youtube" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                    <g id="Group_73" data-name="Group 73" transform="translate(0 0)">
                                        <g id="Group_72" data-name="Group 72">
                                            <path id="Path_93" data-name="Path 93" d="M17.071,2.929A10,10,0,1,0,2.929,17.071,10,10,0,1,0,17.071,2.929ZM10,19.368A9.368,9.368,0,1,1,19.368,10,9.379,9.379,0,0,1,10,19.368Z" transform="translate(0 0)" fill="#9e3ffc"/>
                                        </g>
                                    </g>
                                    <g id="Group_75" data-name="Group 75" transform="translate(2.528 4.212)">
                                        <g id="Group_74" data-name="Group 74">
                                            <path id="Path_94" data-name="Path 94" d="M79.331,109.148a1.146,1.146,0,0,0-1.006-.971,54.638,54.638,0,0,0-12.283,0,1.146,1.146,0,0,0-1.006.971,30.935,30.935,0,0,0,0,8.941,1.146,1.146,0,0,0,1.006.971,54.578,54.578,0,0,0,6.142.346q1.31,0,2.619-.063a.316.316,0,1,0-.032-.631,54,54,0,0,1-8.658-.28.514.514,0,0,1-.452-.435,30.3,30.3,0,0,1,0-8.759.514.514,0,0,1,.452-.435,54.005,54.005,0,0,1,12.141,0,.514.514,0,0,1,.452.435,30.3,30.3,0,0,1,0,8.759.514.514,0,0,1-.452.435h0q-.974.11-1.952.185a.316.316,0,0,0-.292.315h0a.316.316,0,0,0,.339.315q.99-.076,1.977-.187a1.146,1.146,0,0,0,1.006-.971A30.935,30.935,0,0,0,79.331,109.148Z" transform="translate(-64.711 -107.831)" fill="#9e3ffc"/>
                                        </g>
                                    </g>
                                    <g id="Group_77" data-name="Group 77" transform="translate(7.579 6.809)">
                                        <g id="Group_76" data-name="Group 76">
                                            <path id="Path_95" data-name="Path 95" d="M199.957,177.224l-5.474-2.875a.316.316,0,0,0-.463.28v5.75a.316.316,0,0,0,.463.28l5.474-2.875a.316.316,0,0,0,0-.559Zm-5.3,2.632v-4.7l4.479,2.352Z" transform="translate(-194.021 -174.313)" fill="#9e3ffc"/>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="course">
                <div class="course-item-box course-header">
                    <h1 class="course-header-item course-title"><?= Html::encode($course->name); ?></h1>
                    <div class="course-header-item course-rating-wrap">
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
                            <div class="count-comments">(<?= Html::encode($course->getCountsReviews()); ?>)</div>
                        </div>
                    </div>
                    <div class="course-header-item course-price">
                        <p><?= Html::encode($course->price); ?> грн</p>
                    </div>
                </div>
                <div class="course-item-box course-type">
                    <div class="row">
                        <div class="col-xs-6 course-type-item">
                            <p class="course-type-name">Тип обучения</p>
                            <p class="course-type-value"><?= Html::encode($course->courseType->name); ?></p>
                        </div>

                        <?php foreach ($course->values as $i => $value):  ?>
                            <div class="col-xs-6 course-type-item">
                                <p class="course-type-name"><?= Html::encode($value->characteristic->name); ?></p>
                                <p class="course-type-value"><?= Html::encode($value->value); ?></p>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="course-item-box course-description">
                    <h3 class="course-item-box-title">Описание курса</h3>
                    <p>
                        <?= Yii::$app->formatter->asHtml($course->description, [
                            'Attr.AllowedRel' => array('nofollow'),
                            'HTML.SafeObject' => true,
                            'Output.FlashCompat' => true,
                            'HTML.SafeIframe' => true,
                            'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                        ]) ?>
                    </p>
                </div>
                <?php if (!empty($course->gallery)): ?>
                    <div class="course-item-box course-gallery">
                    <h3 class="course-item-box-title">Фотогалерея <span class="gallery-counts">(<?= Html::encode(count($course->gallery)) ?>)</span></h3>
                    <div class="gallery-wrap">
                        <div class="gallery-course-container">
                            <?php foreach ($course->gallery as $galleryItem): ?>
                                <div class="clip">
                                    <a href="<?= $galleryItem->getImageFileUrl('file'); ?>">
                                        <?= Html::img($galleryItem->getThumbFileUrl('file', 'thumb'), ['alt' => 'image_gallery']); ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gallery-nav gallery-nav-prev">
                            <svg id="svg-prev" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="24" viewBox="0 0 14 24"><defs><path id="mf5aa" d="M417.447 1408.238c.353.32.353.84 0 1.16l-11.283 10.21 11.283 10.23c.353.32.353.841 0 1.162a.974.974 0 0 1-1.28 0l-11.902-10.79a.766.766 0 0 1 0-1.162l11.901-10.79a.952.952 0 0 1 1.281-.02z"/></defs><g><g transform="translate(-404 -1408)"><use xlink:href="#mf5aa"/></g></g></svg>
                        </div>
                        <div class="gallery-nav gallery-nav-next">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="24" viewBox="0 0 14 24"><defs><path id="jfona" d="M1205.265 1408.238a.769.769 0 0 0 0 1.16l11.283 10.21-11.283 10.23a.769.769 0 0 0 0 1.162c.353.32.927.32 1.28 0l11.902-10.79a.766.766 0 0 0 0-1.162l-11.902-10.79a.952.952 0 0 0-1.28-.02z"/></defs><g><g transform="translate(-1205 -1408)"><use xlink:href="#jfona"/></g></g></svg>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?= RelatedCoursesWidget::widget([
                    'limit' => 7,
                    'category_id' => $course->category_id,
                    'course_id' => $course->id
                ]) ?>

                <div class="course-item-box course-review">
                    <h3 class="course-item-box-title">Отзывы <span class="counts-reviews">(<?= Html::encode($course->getCountsReviews()); ?>)</span></h3>

                    <?php if (!Yii::$app->user->isGuest): ?>
                        <button class="button create-review" href="#create_review">Оставить отзыв</button>
                    <?php else: ?>
                        <button class="button create-review" href="#courses-login">Оставить отзыв</button>
                    <?php endif; ?>

                    <?php if (!empty($course->reviews)): ?>
                        <div class="course-reviews-container">
                            <?php foreach ($course->reviews as $review): ?>
                                <div class="course-review-item">
                                <div class="course-review-header">
                                    <h4 class="review-username"><?= Html::encode($review->user->first_name); ?>  <?= Html::encode($review->user->last_name); ?></h4>
                                    <div class="rating star-icon value-<?= Html::encode($review->vote); ?> color-ok label-left slow">
                                        <div class="label-value"><?= Html::encode($review->vote); ?></div>
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
                                    <p class="review-date">
                                        <?= CourseHelper::echoDate($review->created_at); ?>
                                        <?php if (!Yii::$app->user->isGuest && $review->isOwner(Yii::$app->user->id)): ?>
                                            <?= Html::a('<span class="text-danger fa fa-trash"></span>', ['delete-review', 'id' => $review->id, 'course_id' => $course->id], [
                                                'class' => 'delete-review',
                                                'data-method' => 'post',
                                                'data-confirm' => 'Вы действилътельно хотите удалить этот елемент?',
                                            ]); ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <p class="review-text"><?= Html::encode($review->text); ?></p>
<!--                                <div class="review-actions">-->
<!--                                    <div class="action action-answer-wrap">-->
<!--                                        <button class="review-action-bnt action-answer">-->
<!--                                            <span class="action-text action-text-answer">Ответить</span>-->
<!--                                            <svg class="review-action-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="12" viewBox="0 0 12 12"><defs><path id="bp5ta" d="M566.618 2350h-9.438c-.65 0-1.18.53-1.18 1.18v10.618l2.36-2.36h8.258c.649 0 1.18-.53 1.18-1.18v-7.078c0-.65-.531-1.18-1.18-1.18z"/></defs><g><g transform="translate(-556 -2350)"><use xlink:href="#bp5ta"/></g></g></svg>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                    <div class="action action-like-wrap">-->
<!--                                        <button class="review-action-bnt action-like">-->
<!--                                            <svg class="review-action-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="12" viewBox="0 0 14 12"><defs><path id="pxnaa" d="M1120.496 2214.882v-7.13h-2.376v7.13zm2.377 0h5.347c.475 0 .89-.297 1.069-.713l1.782-4.218a.859.859 0 0 0 .119-.416v-1.189c0-.653-.535-1.187-1.188-1.187h-3.743l.594-2.733v-.178c0-.238-.119-.476-.238-.654l-.653-.594-3.921 3.921a1.173 1.173 0 0 0-.357.832v5.94c0 .654.535 1.189 1.189 1.189z"/></defs><g><g transform="translate(-1118 -2203)"><use xlink:href="#pxnaa"/></g></g></svg>-->
<!--                                        </button>-->
<!--                                        <span class="action-text like-count">15</span>-->
<!--                                    </div>-->
<!--                                    <div class="action action-unlike-wrap">-->
<!--                                        <button class="review-action-bnt action-unlike">-->
<!--                                            <svg class="review-action-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="12" viewBox="0 0 13 12"><defs><path id="v1o7a" d="M1202.594 2351v7.13h2.376V2351zm-2.377 0h-5.347c-.475 0-.89.297-1.069.713l-1.782 4.218a.859.859 0 0 0-.12.416v1.188c0 .654.536 1.188 1.19 1.188h3.742l-.594 2.733v.178c0 .238.119.475.237.654l.654.594 3.921-3.921c.238-.238.356-.535.356-.832v-5.94c0-.654-.534-1.189-1.188-1.189z"/></defs><g><g transform="translate(-1192 -2351)"><use xlink:href="#v1o7a"/></g></g></svg>-->
<!--                                        </button>-->
<!--                                        <span class="action-text unlike-count">7</span>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="course-info-fixed">
            <div class="col-lg-3">
                <div class="course-info">
                    <div class="courser-info-img">
                        <?php if (!empty($course->mainPhoto)): ?>
                            <?= Html::img($course->mainPhoto->getThumbFileUrl('file', 'thumb'),['alt' => 'image_course']); ?>
                        <?php else: ?>
                            <img src="<?=Url::base()?>/img/no_image.png" alt="img">
                        <?php endif; ?>
                        <div class="favorite-course-top">
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
                                <a href="#courses-login" class="open-popup-courses-login favorite-course-disable favorite-icon-lg hvr-grow" title="в избранное">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="course-info-item course-info-title">
                        <a href="<?= Url::to(['/course/course/firm', 'id' => $course->firm->id]); ?>"><?= Html::encode($course->firm->firm_name); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7" height="12" viewBox="0 0 7 12"><defs><path id="zll9a" d="M1398.508 336.815a.371.371 0 0 0 0 .56l5.448 4.93-5.448 4.939a.371.371 0 0 0 0 .56.47.47 0 0 0 .619 0l5.746-5.21a.37.37 0 0 0 0-.56l-5.746-5.21a.46.46 0 0 0-.619-.009z"/></defs><g><g transform="translate(-1398 -336)"><use fill="#0a0a0a" xlink:href="#zll9a"/></g></g></svg>
                        </a>
                    </div>
                    <div class="course-info-location">
                        <?php if (!empty($course->firm->address)): ?>
                            <div class="course-info-item course-info-address">
                                <p><i class="fa fa-map-marker"></i> <?= Html::encode($course->firm->address); ?></p>
                            </div>
                        <?php endif;?>
                        <?php if (!empty($course->firm->phone_1)): ?>
                            <div class="course-info-item course-info-phone">
                                <p><i class="fa fa-phone"></i> <?= Html::encode($course->firm->phone_1); ?></p>
                            </div>
                        <?php endif;?>
                        <?php if (!empty($course->firm->phone_2)): ?>
                            <div class="course-info-item course-info-phone">
                                <p><i class="fa fa-phone"></i> <?= Html::encode($course->firm->phone_2); ?></p>
                            </div>
                        <?php endif;?>
                        <div class="course-info-item course-info-socs">
                            <?php if (!empty($course->firm->instagram_link)): ?>
                                <a href="<?= Html::encode($course->firm->instagram_link); ?>" title="instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="gva2a" d="M1282 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1282 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1272 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1282 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1292 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="gva2b" d="M1287.181 493.332c0 1.02-.83 1.85-1.849 1.85h-6.664c-1.02 0-1.85-.83-1.85-1.85v-6.664c0-1.02.83-1.85 1.85-1.85h6.664c1.02 0 1.85.83 1.85 1.85v6.664zm-1.849-9.1h-6.664a2.439 2.439 0 0 0-2.436 2.436v6.664a2.439 2.439 0 0 0 2.436 2.436h6.664a2.439 2.439 0 0 0 2.436-2.436v-6.664a2.439 2.439 0 0 0-2.436-2.436z"/><path id="gva2c" d="M1285.026 489.827a3.039 3.039 0 0 0-2.887-2.855 3.034 3.034 0 0 0-3.166 3.17 3.039 3.039 0 0 0 2.856 2.884 3.013 3.013 0 0 0 1.77-.453.29.29 0 0 0 .053-.452l-.005-.004a.292.292 0 0 0-.361-.04c-.381.237-.83.372-1.312.367a2.454 2.454 0 0 1-2.417-2.514 2.447 2.447 0 0 1 2.6-2.37 2.45 2.45 0 0 1 2.279 2.235c.04.488-.065.95-.276 1.348a.292.292 0 0 0 .049.344l.004.004a.29.29 0 0 0 .46-.065c.253-.473.385-1.02.353-1.6z"/><path id="gva2d" d="M1284.608 486.186a.782.782 0 1 1 1.565 0 .782.782 0 0 1-1.565 0z"/></defs><g><g transform="translate(-1272 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#gva2a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2c"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2d"/></g></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->facebook_link)): ?>
                                <a href="<?= Html::encode($course->firm->facebook_link); ?>" title="facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="51c1a" d="M1318.071 482.929A9.934 9.934 0 0 0 1311 480a9.989 9.989 0 0 0-7.071 2.929A9.935 9.935 0 0 0 1301 490c0 2.082.634 4.078 1.833 5.772a9.978 9.978 0 0 0 4.689 3.606.316.316 0 0 0 .425-.305v-5.705a.316.316 0 0 0-.315-.315H1305v-2.316h2.632a.316.316 0 0 0 .315-.316V490c0-2.748 2.607-5.158 5.58-5.158h1.368v2.316h-1.369c-.89 0-1.701.256-2.281.722-.642.515-.982 1.248-.982 2.12v.421c0 .174.142.316.316.316h1.245a.316.316 0 0 0 0-.632h-.93V490c0-1.632 1.418-2.21 2.632-2.21h1.684a.316.316 0 0 0 .316-.316v-2.948a.316.316 0 0 0-.316-.315h-1.684c-1.543 0-3.108.614-4.293 1.684-1.236 1.118-1.917 2.576-1.917 4.105v.105h-2.632a.316.316 0 0 0-.316.316v2.947c0 .175.142.316.316.316h2.632v4.932a9.413 9.413 0 0 1-5.684-8.616c0-5.166 4.202-9.368 9.368-9.368 5.16 0 9.368 4.208 9.368 9.368 0 5.166-4.202 9.368-9.368 9.368h-.105v-5.684h4.315a.316.316 0 0 0 .316-.316v-2.947a.316.316 0 0 0-.316-.316h-1.848a.316.316 0 0 0 0 .632h1.533v2.316h-4.316a.316.316 0 0 0-.316.315v6.307c0 .168.133.308.302.315a9.934 9.934 0 0 0 7.506-2.919A9.989 9.989 0 0 0 1321 490a9.935 9.935 0 0 0-2.929-7.071z"/></defs><g><g transform="translate(-1301 -480)"><g><g><use fill="#9e3ffc" xlink:href="#51c1a"/></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->vk_link)): ?>
                                <a href="<?= Html::encode($course->firm->vk_link); ?>" title="telegram">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="uqp5a" d="M1340 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1340 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1330 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1340 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1350 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="uqp5b" d="M1344.794 484.007a.307.307 0 0 0-.326-.027l-11.876 6.142a.307.307 0 0 0 .004.548l3.106 1.553v3.077a.308.308 0 0 0 .456.277l3.554-1.974 2.72 1.166a.308.308 0 0 0 .43-.219l.689-3.44a.307.307 0 0 0-.603-.121l-.614 3.07-2.518-1.08a.307.307 0 0 0-.27.014l-3.23 1.794v-2.754a.307.307 0 0 0-.17-.275l-2.735-1.368 10.771-5.571-.935 4.674a.307.307 0 0 0 .603.12l1.06-5.3a.307.307 0 0 0-.116-.306z"/><path id="uqp5c" d="M1338.989 490.602a.307.307 0 0 0-.058.08l-.646 1.293v-1.803l2.949-1.815zm4.553-4.068a.307.307 0 0 0-.402-.072l-5.324 3.276a.307.307 0 0 0-.146.262v3.276a.307.307 0 0 0 .582.137l1.206-2.412 4.06-4.06c.11-.11.12-.285.024-.407z"/></defs><g><g transform="translate(-1330 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5c"/></g></g></g></g></g></svg>
                                </a>
                            <?php endif;?>
                            <?php if (!empty($course->firm->youtube_link)): ?>
                                <a href="<?= Html::encode($course->firm->youtube_link); ?>" title="youtube">
                                    <svg id="youtube_2_" data-name="youtube" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Group_73" data-name="Group 73" transform="translate(0 0)">
                                            <g id="Group_72" data-name="Group 72">
                                                <path id="Path_93" data-name="Path 93" d="M17.071,2.929A10,10,0,1,0,2.929,17.071,10,10,0,1,0,17.071,2.929ZM10,19.368A9.368,9.368,0,1,1,19.368,10,9.379,9.379,0,0,1,10,19.368Z" transform="translate(0 0)" fill="#9e3ffc"/>
                                            </g>
                                        </g>
                                        <g id="Group_75" data-name="Group 75" transform="translate(2.528 4.212)">
                                            <g id="Group_74" data-name="Group 74">
                                                <path id="Path_94" data-name="Path 94" d="M79.331,109.148a1.146,1.146,0,0,0-1.006-.971,54.638,54.638,0,0,0-12.283,0,1.146,1.146,0,0,0-1.006.971,30.935,30.935,0,0,0,0,8.941,1.146,1.146,0,0,0,1.006.971,54.578,54.578,0,0,0,6.142.346q1.31,0,2.619-.063a.316.316,0,1,0-.032-.631,54,54,0,0,1-8.658-.28.514.514,0,0,1-.452-.435,30.3,30.3,0,0,1,0-8.759.514.514,0,0,1,.452-.435,54.005,54.005,0,0,1,12.141,0,.514.514,0,0,1,.452.435,30.3,30.3,0,0,1,0,8.759.514.514,0,0,1-.452.435h0q-.974.11-1.952.185a.316.316,0,0,0-.292.315h0a.316.316,0,0,0,.339.315q.99-.076,1.977-.187a1.146,1.146,0,0,0,1.006-.971A30.935,30.935,0,0,0,79.331,109.148Z" transform="translate(-64.711 -107.831)" fill="#9e3ffc"/>
                                            </g>
                                        </g>
                                        <g id="Group_77" data-name="Group 77" transform="translate(7.579 6.809)">
                                            <g id="Group_76" data-name="Group 76">
                                                <path id="Path_95" data-name="Path 95" d="M199.957,177.224l-5.474-2.875a.316.316,0,0,0-.463.28v5.75a.316.316,0,0,0,.463.28l5.474-2.875a.316.316,0,0,0,0-.559Zm-5.3,2.632v-4.7l4.479,2.352Z" transform="translate(-194.021 -174.313)" fill="#9e3ffc"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            <?php endif;?>
                        </div>
                        <div class="course-info-footer sticky" id="course-info-footer">
                            <?php $form = ActiveForm::begin([
                                'id' => 'orderCreateForm',
                                'enableAjaxValidation'=>false,
                                'enableClientValidation'=>false,
                            ]); ?>

                                <?= $form->field($orderCreateForm, 'course_id')->hiddenInput(['value'=> $course->id])->label(false); ?>
                                <?= $form->field($orderCreateForm, 'teacher_id')->hiddenInput(['value'=> $course->user_id])->label(false); ?>
                                <?= $form->field($orderCreateForm, 'price')->hiddenInput(['value'=> $course->price])->label(false); ?>

                                <p>Получите детальную информацию о курсе и ближайших датах </p>

                                <?= $form->field($orderCreateForm, 'username')->textInput(['class' => 'course-info-input']); ?>

                                <?= $form->field($orderCreateForm, 'phone')->textInput(['class' => 'course-info-input', 'data-mask' => 'callback-catalog-phone', 'placeholder' => '+380 ']); ?>

                                <button type="submit" class="btn btn-block course-info-footer-btn">Узнать подробнее</button>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--fixed button btns-->
    <div class="bottom-fixed-block">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 fixed-buttons-wrap">
                    <div class="button-fixed left-button">
                        <a href="#phones_md" class="open-popup-course btn btn-block">
                            Контакты
                        </a>
                    </div>
                    <div class="button-fixed right-button">
                        <a href="#more_md" class="open-popup-course btn btn-block" id="click_link">
                            <span class="right-button-left-word">Узнать</span> <span class="right-button-right-word">подробнее</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--modals-->
    <div id="more_md" class="white-popup mfp-hide create-order-popup">
        <div class="course-info-footer">
            <?php $form = ActiveForm::begin([
                'id' => 'orderCreateFormSm',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>false,
            ]); ?>

                <?= $form->field($orderCreateForm, 'course_id')->hiddenInput(['value'=> $course->id, 'id' => 'course_id_sm'])->label(false); ?>
                <?= $form->field($orderCreateForm, 'teacher_id')->hiddenInput(['value'=> $course->user_id, 'id' => 'teacher_id_sm'])->label(false); ?>
                <?= $form->field($orderCreateForm, 'price')->hiddenInput(['value'=> $course->price, 'id' => 'price_sm'])->label(false); ?>

                <p>Получите детальную информацию о курсе и ближайших датах </p>

                <?= $form->field($orderCreateForm, 'username')->textInput(['class' => 'course-info-input', 'id' => 'username_sm']); ?>

                <?= $form->field($orderCreateForm, 'phone')->textInput(['class' => 'course-info-input', 'id' => 'phone_sm', 'data-mask' => 'callback-catalog-phone', 'placeholder' => '+380 ']); ?>

                <button type="submit" class="btn btn-block course-info-footer-btn">Узнать подробнее</button>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div id="phones_md" class="white-popup mfp-hide phones-md">
        <?php if (!empty($course->firm->phone_1)): ?>
            <a href="tel:<?= Html::encode($course->firm->phone_1) ?>">
                <?= Html::encode($course->firm->phone_1) ?>
            </a>
        <?php endif; ?>
        <?php if (!empty($course->firm->phone_2)): ?>
            <a href="tel:<?= Html::encode($course->firm->phone_2) ?>">
                <?= Html::encode($course->firm->phone_2) ?>
            </a>
        <?php endif; ?>
    </div>
    <div id="create_review" class="white-popup mfp-hide create-review-form">
        <h2 class="create-review-popup-title">Оцените курс</h2>
        <?php $form = ActiveForm::begin(['id' => 'form-review', 'class' => 'review-form']) ?>
            <div class="review-stars">
                <div class="review-stars-item">
                    <p>Оценка курса</p>
                    <div class="star-rating">
                        <div class="star-rating__wrap">
                            <input class="star-rating__input" id="vote-5" type="radio" name="ReviewForm[vote]" value="5">
                            <label class="star-rating__ico fa fa-star-o fa-lg" for="vote-5" title="5 out of 5 stars"></label>
                            <input class="star-rating__input" id="vote-4" type="radio" name="ReviewForm[vote]" value="4">
                            <label class="star-rating__ico fa fa-star-o fa-lg" for="vote-4" title="4 out of 5 stars"></label>
                            <input class="star-rating__input" id="vote-3" type="radio" name="ReviewForm[vote]" value="3">
                            <label class="star-rating__ico fa fa-star-o fa-lg" for="vote-3" title="3 out of 5 stars"></label>
                            <input class="star-rating__input" id="vote-2" type="radio" name="ReviewForm[vote]" value="2">
                            <label class="star-rating__ico fa fa-star-o fa-lg" for="vote-2" title="2 out of 5 stars"></label>
                            <input class="star-rating__input" id="vote-1" type="radio" name="ReviewForm[vote]" value="1">
                            <label class="star-rating__ico fa fa-star-o fa-lg" for="vote-1" title="1 out of 5 stars"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group review-textarea">
                <?= $form->field($reviewForm, 'text')->textarea(['rows' => 7, 'cols'=> 100, 'placeholder' => 'Введите текст...']) ?>
            </div>
        <button type="submit" class="btn btn-block button">Отправить</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
