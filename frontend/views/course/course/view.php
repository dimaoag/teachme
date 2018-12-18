<?php



/* @var $course shop\entities\shop\course\Course */

$this->title = $course->name;

foreach ($course->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['/course/course/category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $course->name;

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\course\RelatedCoursesWidget;
?>


<main>
    <div class="container course-wrap">
        <div class="row">
            <div class="course-info-small">
                <div class="col-lg-3">
                    <div class="course-info">
                        <div class="courser-info-img">
                            <?= Html::img($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>
                            <div class="course-info-socs">
                                <a href="<?= Html::encode($course->firm->instagram_link) ; ?>">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->facebook_link); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->vk_link); ?>">
                                    <i class="fa fa-vk"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->youtube_link); ?>">
                                    <i class="fa fa-youtube-play"></i>
                                </a>
                            </div>
                            <div class="favorite-course-top">
                                <a href="#" class="favorite-toggle hvr-grow">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </div>
                        </div>
                        <div class="course-info-title">
                            <?= Html::a(Html::encode($course->firm->firm_name), ['/course/course/firm', 'id' => $course->firm->id]); ?>
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($course->firm->address)): ?>
                                <div class="course-info-address">
                                    <p><i class="fa fa-map-marker"></i>
                                        <?= Html::encode($course->firm->address); ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($course->firm->phone_1)): ?>
                                <div class="course-info-phone">
                                    <p><i class="fa fa-phone"></i>
                                        <?= Html::encode($course->firm->phone_1); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($course->firm->phone_2)): ?>
                                <div class="course-info-phone">
                                    <p><i class="fa fa-phone"></i>
                                        <?= Html::encode($course->firm->phone_2); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="course">
                    <div class="course-header">
                        <h1 class="course-header-item"><?= Html::encode($course->name); ?></h1>
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
                            </div>
                        </div>
                        <div class="course-header-item course-price">
                            <p><?= Html::encode($course->price); ?> грн</p>
                        </div>
                    </div>
                    <div class="course-type">
                        <div class="row course-type-wrap">
                            <?php foreach ($course->values as $i => $value):  ?>
                            <div class="col-xs-6 course-type-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="course-type-name">
                                            <p><?= Html::encode($value->characteristic->name); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="course-type-value">
                                            <p><?= Html::encode($value->value); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="course-description">
                        <h3>Описание курса</h3>
                        <p><?= Html::encode($course->description); ?></p>
                    </div>
                    <?php if (!empty($course->gallery)): ?>
                        <div class="course-gallery">
                            <h3>Фотогалерея</h3>
                                <div class="gallery left-align-slick center">
                                    <?php foreach ($course->gallery as $galleryItem): ?>
                                    <div class="clip">
                                        <a href="<?= $galleryItem->getThumbFileUrl('file', 'thumb'); ?>">
                                            <?= Html::img($galleryItem->getThumbFileUrl('file', 'thumb')); ?>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <div class="gallery-controll">
                                <div class="gallery-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                                <div class="gallery-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?= RelatedCoursesWidget::widget([
                        'limit' => 7,
                        'category_id' => $course->category_id,
                        'course_id' => $course->id
                    ]) ?>

                    <div class="course-review">
                        <h3>Отзывы</h3>
                        <button class="button create-review hvr-grow" href="#create_review">Оставить отзыв</button>
                        <div class="course-reviews-container">
                            <div class="course-review-item">
                                <div class="course-review-header">
                                    <div class="course-review-header-left">
                                        <h4>John Smith</h4>
                                        <p>20-10-2018 15:35</p>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, assumenda blanditiis ducimus ex, hic ipsum libero neque nobis odio officia rem ullam unde! Autem cumque maiores nostrum odio provident voluptates?</p>
                            </div>
                            <div class="course-review-item">
                                <div class="course-review-header">
                                    <div class="course-review-header-left">
                                        <h4>John Smith</h4>
                                        <p>20-10-2018 15:35</p>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, assumenda blanditiis ducimus ex, hic ipsum libero neque nobis odio officia rem ullam unde! Autem cumque maiores nostrum odio provident voluptates?</p>
                            </div>
                            <div class="course-review-item">
                                <div class="course-review-header">
                                    <div class="course-review-header-left">
                                        <h4>John Smith</h4>
                                        <p>20-10-2018 15:35</p>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, assumenda blanditiis ducimus ex, hic ipsum libero neque nobis odio officia rem ullam unde! Autem cumque maiores nostrum odio provident voluptates?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-info-fixed">
                <div class="col-lg-3">
                    <div class="course-info">
                        <div class="course-info-favorite">
                            <p>
                                <a href="#" class="favorite-toggle hvr-grow"><i class="fa fa-heart-o"></i></a> в избраное
                            </p>
                        </div>
                        <div class="courser-info-img">
                            <?php if ($course->firm->firm_photo): ?>
                                <?= Html::img($course->mainPhoto->getThumbFileUrl('file', 'thumb')); ?>
                            <?php else: ?>
                                <img src="<?=Url::base()?>/img/no_image.png" alt="img">
                            <?php endif; ?>
                            <div class="course-info-socs">
                                <a href="<?= Html::encode($course->firm->instagram_link); ?>">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->facebook_link); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->vk_link); ?>">
                                    <i class="fa fa-vk"></i>
                                </a>
                                <a href="<?= Html::encode($course->firm->youtube_link); ?>">
                                    <i class="fa fa-youtube-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="course-info-title">
                            <?= Html::a(Html::encode($course->firm->firm_name), ['/course/course/firm', 'id' => $course->firm->id]); ?>
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($course->firm->address)): ?>
                                <div class="course-info-address">
                                    <p>
                                        <i class="fa fa-map-marker"></i>
                                        <?= Html::encode($course->firm->address); ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($course->firm->phone_1)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($course->firm->phone_1); ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($course->firm->phone_2)): ?>
                                <div class="course-info-phone">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <?= Html::encode($course->firm->phone_2); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <div class="course-info-footer">
                                <form action="#">
                                    <p>Получите детальную информацию о курсе и ближайших датах </p>
                                    <input type="text" name="phone" data-mask="callback-catalog-phone" class="course-info-input" placeholder="+380 __-___-__-__" required>
                                    <button href="#" class="btn btn-block course-info-footer-btn">Узнать подробнее</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--fixed button btns-->
        <div class="bottom-fixed">
            <div class="left-button">
                <a href="#phones_md" class="open-popup-phones_md btn btn-block">
                    Контакты
                </a>
            </div>
            <div class="right-button">
                <a href="#more_md" class="open-popup-more_md btn btn-block" id="click_link">
                    Узнать подробнее
                </a>
            </div>
        </div>

        <!--modals-->
        <div id="more_md" class="white-popup mfp-hide">
            <div class="course-info-footer">
                <form action="#" autocomplete="off">
                    <p>Получите детальную информацию о курсе и ближайших датах </p>
                    <input type="text" name="phone" data-mask="callback-catalog-phone" class="course-info-input" placeholder="+380 __-___-__-__" required>
                    <button href="#" class="btn btn-block course-info-footer-btn" type="submit">Узнать подробнее</button>
                </form>
            </div>
        </div>
        <div id="phones_md" class="white-popup mfp-hide phones-md">
            <a href="tel:0979746559">
                +380979746559
            </a>
            <a href="tel:0979746559">
                +380979746559
            </a>
        </div>
        <div id="create_review" class="white-popup mfp-hide create-review-form">
            <h2>Оцените курс</h2>
            <form action="#" role="form" class="review-form">
                <div class="review-stars">
                    <div class="review-stars-item">
                        <p>Место проведения</p>
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-place-5" type="radio" name="rating_place" value="5">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-place-5" title="5 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-place-4" type="radio" name="rating_place" value="4">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-place-4" title="4 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-place-3" type="radio" name="rating_place" value="3">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-place-3" title="3 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-place-2" type="radio" name="rating_place" value="2">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-place-2" title="2 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-place-1" type="radio" name="rating_place" value="1">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-place-1" title="1 out of 5 stars"></label>
                            </div>
                        </div>
                    </div>
                    <div class="review-stars-item">
                        <p>Преподаватель</p>
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-teacher-5" type="radio" name="rating-teacher" value="5">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-teacher-5" title="5 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-teacher-4" type="radio" name="rating-teacher" value="4">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-teacher-4" title="4 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-teacher-3" type="radio" name="rating-teacher" value="3">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-teacher-3" title="3 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-teacher-2" type="radio" name="rating-teacher" value="2">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-teacher-2" title="2 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-teacher-1" type="radio" name="rating-teacher" value="1">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-teacher-1" title="1 out of 5 stars"></label>
                            </div>
                        </div>
                    </div>
                    <div class="review-stars-item">
                        <p>Практика</p>
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-practice-5" type="radio" name="rating-practice" value="5">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-practice-5" title="5 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-practice-4" type="radio" name="rating-practice" value="4">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-practice-4" title="4 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-practice-3" type="radio" name="rating-practice" value="3">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-practice-3" title="3 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-practice-2" type="radio" name="rating-practice" value="2">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-practice-2" title="2 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-practice-1" type="radio" name="rating-practice" value="1">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-practice-1" title="1 out of 5 stars"></label>
                            </div>
                        </div>
                    </div>
                    <div class="review-stars-item">
                        <p>Цена-качество</p>
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-price-5" type="radio" name="rating-price" value="5">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-price-5" title="5 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-price-4" type="radio" name="rating-price" value="4">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-price-4" title="4 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-price-3" type="radio" name="rating-price" value="3">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-price-3" title="3 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-price-2" type="radio" name="rating-price" value="2">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-price-2" title="2 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-price-1" type="radio" name="rating-price" value="1">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-price-1" title="1 out of 5 stars"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group review-textarea">
                    <label for="review">Оставить отзыв</label>
                    <textarea rows="7" cols="100" class="form-control" id="review"  placeholder="Введите текст"></textarea>
                </div>
                <button type="submit" class="btn btn-block button">Отправить</button>
            </form>
        </div>
    </div>
</main>
