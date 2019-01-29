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
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($firm->address)): ?>
                                <div class="course-info-item course-info-address">
                                    <p><i class="fa fa-map-marker"></i> <?= Html::encode($firm->address); ?></p>
                                </div>
                            <?php endif;?>
                            <?php if (!empty($firm->phone_1)): ?>
                                <div class="course-info-item course-info-phone">
                                    <a href="tel:<?= Html::encode($firm->phone_1); ?>"><i class="fa fa-phone"></i> <?= Html::encode($firm->phone_1); ?></a>
                                </div>
                            <?php endif;?>
                            <?php if (!empty($firm->phone_2)): ?>
                                <div class="course-info-item course-info-phone">
                                    <a href="tel:<?= Html::encode($firm->phone_2); ?>"><i class="fa fa-phone"></i> <?= Html::encode($firm->phone_2); ?></a>
                                </div>
                            <?php endif;?>
                            <div class="course-info-item course-info-socs">
                                <?php if (!empty($firm->instagram_link)): ?>
                                    <a href="<?= Html::encode($firm->instagram_link); ?>" title="instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="gva2a" d="M1282 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1282 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1272 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1282 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1292 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="gva2b" d="M1287.181 493.332c0 1.02-.83 1.85-1.849 1.85h-6.664c-1.02 0-1.85-.83-1.85-1.85v-6.664c0-1.02.83-1.85 1.85-1.85h6.664c1.02 0 1.85.83 1.85 1.85v6.664zm-1.849-9.1h-6.664a2.439 2.439 0 0 0-2.436 2.436v6.664a2.439 2.439 0 0 0 2.436 2.436h6.664a2.439 2.439 0 0 0 2.436-2.436v-6.664a2.439 2.439 0 0 0-2.436-2.436z"/><path id="gva2c" d="M1285.026 489.827a3.039 3.039 0 0 0-2.887-2.855 3.034 3.034 0 0 0-3.166 3.17 3.039 3.039 0 0 0 2.856 2.884 3.013 3.013 0 0 0 1.77-.453.29.29 0 0 0 .053-.452l-.005-.004a.292.292 0 0 0-.361-.04c-.381.237-.83.372-1.312.367a2.454 2.454 0 0 1-2.417-2.514 2.447 2.447 0 0 1 2.6-2.37 2.45 2.45 0 0 1 2.279 2.235c.04.488-.065.95-.276 1.348a.292.292 0 0 0 .049.344l.004.004a.29.29 0 0 0 .46-.065c.253-.473.385-1.02.353-1.6z"/><path id="gva2d" d="M1284.608 486.186a.782.782 0 1 1 1.565 0 .782.782 0 0 1-1.565 0z"/></defs><g><g transform="translate(-1272 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#gva2a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2c"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2d"/></g></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->facebook_link)): ?>
                                    <a href="<?= Html::encode($firm->facebook_link); ?>" title="facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="51c1a" d="M1318.071 482.929A9.934 9.934 0 0 0 1311 480a9.989 9.989 0 0 0-7.071 2.929A9.935 9.935 0 0 0 1301 490c0 2.082.634 4.078 1.833 5.772a9.978 9.978 0 0 0 4.689 3.606.316.316 0 0 0 .425-.305v-5.705a.316.316 0 0 0-.315-.315H1305v-2.316h2.632a.316.316 0 0 0 .315-.316V490c0-2.748 2.607-5.158 5.58-5.158h1.368v2.316h-1.369c-.89 0-1.701.256-2.281.722-.642.515-.982 1.248-.982 2.12v.421c0 .174.142.316.316.316h1.245a.316.316 0 0 0 0-.632h-.93V490c0-1.632 1.418-2.21 2.632-2.21h1.684a.316.316 0 0 0 .316-.316v-2.948a.316.316 0 0 0-.316-.315h-1.684c-1.543 0-3.108.614-4.293 1.684-1.236 1.118-1.917 2.576-1.917 4.105v.105h-2.632a.316.316 0 0 0-.316.316v2.947c0 .175.142.316.316.316h2.632v4.932a9.413 9.413 0 0 1-5.684-8.616c0-5.166 4.202-9.368 9.368-9.368 5.16 0 9.368 4.208 9.368 9.368 0 5.166-4.202 9.368-9.368 9.368h-.105v-5.684h4.315a.316.316 0 0 0 .316-.316v-2.947a.316.316 0 0 0-.316-.316h-1.848a.316.316 0 0 0 0 .632h1.533v2.316h-4.316a.316.316 0 0 0-.316.315v6.307c0 .168.133.308.302.315a9.934 9.934 0 0 0 7.506-2.919A9.989 9.989 0 0 0 1321 490a9.935 9.935 0 0 0-2.929-7.071z"/></defs><g><g transform="translate(-1301 -480)"><g><g><use fill="#9e3ffc" xlink:href="#51c1a"/></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->vk_link)): ?>
                                    <a href="<?= Html::encode($firm->vk_link); ?>" title="telegram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="uqp5a" d="M1340 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1340 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1330 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1340 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1350 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="uqp5b" d="M1344.794 484.007a.307.307 0 0 0-.326-.027l-11.876 6.142a.307.307 0 0 0 .004.548l3.106 1.553v3.077a.308.308 0 0 0 .456.277l3.554-1.974 2.72 1.166a.308.308 0 0 0 .43-.219l.689-3.44a.307.307 0 0 0-.603-.121l-.614 3.07-2.518-1.08a.307.307 0 0 0-.27.014l-3.23 1.794v-2.754a.307.307 0 0 0-.17-.275l-2.735-1.368 10.771-5.571-.935 4.674a.307.307 0 0 0 .603.12l1.06-5.3a.307.307 0 0 0-.116-.306z"/><path id="uqp5c" d="M1338.989 490.602a.307.307 0 0 0-.058.08l-.646 1.293v-1.803l2.949-1.815zm4.553-4.068a.307.307 0 0 0-.402-.072l-5.324 3.276a.307.307 0 0 0-.146.262v3.276a.307.307 0 0 0 .582.137l1.206-2.412 4.06-4.06c.11-.11.12-.285.024-.407z"/></defs><g><g transform="translate(-1330 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5c"/></g></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->youtube_link)): ?>
                                    <a href="<?= Html::encode($firm->youtube_link); ?>" title="youtube">
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

            <div class="col-md-9 search-courses-container firm-courses-container">

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
                        </div>
                        <div class="course-info-location">
                            <?php if (!empty($firm->address)): ?>
                                <div class="course-info-item course-info-address">
                                    <p><i class="fa fa-map-marker"></i> <?= Html::encode($firm->address); ?></p>
                                </div>
                            <?php endif;?>
                            <?php if (!empty($firm->phone_1)): ?>
                                <div class="course-info-item course-info-phone">
                                    <a href="tel:<?= Html::encode($firm->phone_1); ?>"><i class="fa fa-phone"></i> <?= Html::encode($firm->phone_1); ?></a>
                                </div>
                            <?php endif;?>
                            <?php if (!empty($firm->phone_2)): ?>
                                <div class="course-info-item course-info-phone">
                                    <a href="tel:<?= Html::encode($firm->phone_2); ?>"><i class="fa fa-phone"></i> <?= Html::encode($firm->phone_2); ?></a>
                                </div>
                            <?php endif;?>
                            <div class="course-info-item course-info-socs">
                                <?php if (!empty($firm->instagram_link)): ?>
                                    <a href="<?= Html::encode($firm->instagram_link); ?>" title="instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="gva2a" d="M1282 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1282 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1272 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1282 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1292 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="gva2b" d="M1287.181 493.332c0 1.02-.83 1.85-1.849 1.85h-6.664c-1.02 0-1.85-.83-1.85-1.85v-6.664c0-1.02.83-1.85 1.85-1.85h6.664c1.02 0 1.85.83 1.85 1.85v6.664zm-1.849-9.1h-6.664a2.439 2.439 0 0 0-2.436 2.436v6.664a2.439 2.439 0 0 0 2.436 2.436h6.664a2.439 2.439 0 0 0 2.436-2.436v-6.664a2.439 2.439 0 0 0-2.436-2.436z"/><path id="gva2c" d="M1285.026 489.827a3.039 3.039 0 0 0-2.887-2.855 3.034 3.034 0 0 0-3.166 3.17 3.039 3.039 0 0 0 2.856 2.884 3.013 3.013 0 0 0 1.77-.453.29.29 0 0 0 .053-.452l-.005-.004a.292.292 0 0 0-.361-.04c-.381.237-.83.372-1.312.367a2.454 2.454 0 0 1-2.417-2.514 2.447 2.447 0 0 1 2.6-2.37 2.45 2.45 0 0 1 2.279 2.235c.04.488-.065.95-.276 1.348a.292.292 0 0 0 .049.344l.004.004a.29.29 0 0 0 .46-.065c.253-.473.385-1.02.353-1.6z"/><path id="gva2d" d="M1284.608 486.186a.782.782 0 1 1 1.565 0 .782.782 0 0 1-1.565 0z"/></defs><g><g transform="translate(-1272 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#gva2a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2c"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#gva2d"/></g></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->facebook_link)): ?>
                                    <a href="<?= Html::encode($firm->facebook_link); ?>" title="facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="51c1a" d="M1318.071 482.929A9.934 9.934 0 0 0 1311 480a9.989 9.989 0 0 0-7.071 2.929A9.935 9.935 0 0 0 1301 490c0 2.082.634 4.078 1.833 5.772a9.978 9.978 0 0 0 4.689 3.606.316.316 0 0 0 .425-.305v-5.705a.316.316 0 0 0-.315-.315H1305v-2.316h2.632a.316.316 0 0 0 .315-.316V490c0-2.748 2.607-5.158 5.58-5.158h1.368v2.316h-1.369c-.89 0-1.701.256-2.281.722-.642.515-.982 1.248-.982 2.12v.421c0 .174.142.316.316.316h1.245a.316.316 0 0 0 0-.632h-.93V490c0-1.632 1.418-2.21 2.632-2.21h1.684a.316.316 0 0 0 .316-.316v-2.948a.316.316 0 0 0-.316-.315h-1.684c-1.543 0-3.108.614-4.293 1.684-1.236 1.118-1.917 2.576-1.917 4.105v.105h-2.632a.316.316 0 0 0-.316.316v2.947c0 .175.142.316.316.316h2.632v4.932a9.413 9.413 0 0 1-5.684-8.616c0-5.166 4.202-9.368 9.368-9.368 5.16 0 9.368 4.208 9.368 9.368 0 5.166-4.202 9.368-9.368 9.368h-.105v-5.684h4.315a.316.316 0 0 0 .316-.316v-2.947a.316.316 0 0 0-.316-.316h-1.848a.316.316 0 0 0 0 .632h1.533v2.316h-4.316a.316.316 0 0 0-.316.315v6.307c0 .168.133.308.302.315a9.934 9.934 0 0 0 7.506-2.919A9.989 9.989 0 0 0 1321 490a9.935 9.935 0 0 0-2.929-7.071z"/></defs><g><g transform="translate(-1301 -480)"><g><g><use fill="#9e3ffc" xlink:href="#51c1a"/></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->vk_link)): ?>
                                    <a href="<?= Html::encode($firm->vk_link); ?>" title="telegram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="uqp5a" d="M1340 499.368c-5.166 0-9.368-4.202-9.368-9.368s4.202-9.368 9.368-9.368 9.368 4.202 9.368 9.368-4.202 9.368-9.368 9.368zm7.071-16.44A9.934 9.934 0 0 0 1340 480a9.934 9.934 0 0 0-7.071 2.929A9.934 9.934 0 0 0 1330 490a9.934 9.934 0 0 0 2.929 7.071A9.934 9.934 0 0 0 1340 500a9.934 9.934 0 0 0 7.071-2.929A9.935 9.935 0 0 0 1350 490a9.934 9.934 0 0 0-2.929-7.071z"/><path id="uqp5b" d="M1344.794 484.007a.307.307 0 0 0-.326-.027l-11.876 6.142a.307.307 0 0 0 .004.548l3.106 1.553v3.077a.308.308 0 0 0 .456.277l3.554-1.974 2.72 1.166a.308.308 0 0 0 .43-.219l.689-3.44a.307.307 0 0 0-.603-.121l-.614 3.07-2.518-1.08a.307.307 0 0 0-.27.014l-3.23 1.794v-2.754a.307.307 0 0 0-.17-.275l-2.735-1.368 10.771-5.571-.935 4.674a.307.307 0 0 0 .603.12l1.06-5.3a.307.307 0 0 0-.116-.306z"/><path id="uqp5c" d="M1338.989 490.602a.307.307 0 0 0-.058.08l-.646 1.293v-1.803l2.949-1.815zm4.553-4.068a.307.307 0 0 0-.402-.072l-5.324 3.276a.307.307 0 0 0-.146.262v3.276a.307.307 0 0 0 .582.137l1.206-2.412 4.06-4.06c.11-.11.12-.285.024-.407z"/></defs><g><g transform="translate(-1330 -480)"><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5a"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5b"/></g></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#uqp5c"/></g></g></g></g></g></svg>
                                    </a>
                                <?php endif;?>
                                <?php if (!empty($firm->youtube_link)): ?>
                                    <a href="<?= Html::encode($firm->youtube_link); ?>" title="youtube">
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
        </div>
    </div>
</main>
