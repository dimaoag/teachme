<?php

/* @var $this \yii\web\View */
/* @var $content string */

use shop\helpers\CategoryHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use shop\helpers\UserHelper;

?>

<?php $this->beginContent('@frontend/views/layouts/layout.php') ?>

    <header>
        <nav class="navbar navbar-dark header-top">
            <div class="container header-container">
                <div class="navbar-header">
                    <a class="navbar-brand logo" href="<?=Url::home()?>">
                        <img src="<?= Url::base() ?>/img/logo.png" alt="logo">
                    </a>
                    <a class="navbar-brand logo-small" href="<?=Url::home()?>">
                        <img src="<?= Url::base() ?>/img/logo-small.png" alt="logo">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="<?=Url::home()?>">Главная</a></li>
                        <li><a href="<?=Url::to(['/course/search/search', 'courseType[]' => '1'])?>">Курсы</a></li>
                        <li><a href="<?=Url::to(['/course/search/search', 'courseType[]' => '2'])?>">Мастер-класы</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!Yii::$app->user->isGuest):  ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle header-auth-links header-auth-links-profile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 7.605 10">
                                        <g id="man-user" transform="translate(-1400 -15)">
                                            <path id="Path_19" class="header-icon-svg" data-name="Path 19" d="M106.548,4.891a2.261,2.261,0,0,0,2.013-2.445c0-1.351-.3-2.445-2.013-2.445s-2.013,1.095-2.013,2.445A2.261,2.261,0,0,0,106.548,4.891Z" transform="translate(1297.255 15)"/>
                                            <path id="Path_22" class="header-icon-svg" data-name="Path 22" d="M49.509,181.187c-.037-2.353-.345-3.023-2.7-3.447a1.652,1.652,0,0,1-2.2,0c-2.326.42-2.652,1.08-2.694,3.371,0,.187-.005.2-.006.175,0,.041,0,.116,0,.247,0,0,.56,1.128,3.8,1.128s3.8-1.128,3.8-1.128c0-.084,0-.143,0-.183A1.515,1.515,0,0,1,49.509,181.187Z" transform="translate(1358.092 -157.662)"/>
                                        </g>
                                    </svg>
                                    <p>Мой кабинет</p>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            <ul class="dropdown-menu header-profile-menu">
                                <li><a href="<?=UserHelper::getCabinetLink();?>" class="dropdown-profile-menu-link username"><?= Html::encode(Yii::$app->user->identity->first_name);?> <?= Html::encode(Yii::$app->user->identity->last_name);?></a></li>
                                <?php if (UserHelper::isUserTeacher()): ?>
                                    <li>
                                        <a href="<?=Url::to(['/cabinet/teacher/default/index']);?>" class="dropdown-profile-menu-link">
                                            <svg id="icon" xmlns="http://www.w3.org/2000/svg" width="12.393" height="10.981"
                                                 viewBox="0 0 12.393 10.981">
                                                <g id="c14_house" transform="translate(0)">
                                                    <path id="Path_48" data-name="Path 48" d="M3.588,14.547a.257.257,0,0,0,.26.277l3.124,0,0-2.56s-.044-.422.365-.422h1.3a.4.4,0,0,1,.455.422l-.006,2.552h3.058a.32.32,0,0,0,.328-.345V9.747L8.163,5.913,3.588,9.747Z" transform="translate(-1.903 -3.842)" fill="#0a0a0a"/>
                                                    <path id="Path_49" data-name="Path 49" d="M0,7.052s.388.716,1.236,0L6.3,2.768l4.746,4.257c.981.707,1.348,0,1.348,0L6.3,1.5Z" transform="translate(0 -1.504)" fill="#0a0a0a"/>
                                                    <path id="Path_50" data-name="Path 50" d="M21.895,4.175H20.674l.005,1.481,1.215,1.032Z" transform="translate(-10.965 -2.921)" fill="#0a0a0a"/>
                                                </g>
                                            </svg>
                                            <p>Мои курсы</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['/cabinet/teacher/default/orders']);?>" class="dropdown-profile-menu-link">
                                            <svg id="target" xmlns="http://www.w3.org/2000/svg" width="12.393"
                                                 height="12.391" viewBox="0 0 12.393 12.391">
                                                <g id="Group_11" data-name="Group 11" transform="translate(0 0)">
                                                    <path id="Path_29" data-name="Path 29" d="M182.745,5.534a1.18,1.18,0,1,0,.866,1.137,1.161,1.161,0,0,0-.043-.314l3.288-3.288.532.071,1.664-1.664-1.259-.167L187.626.05l-1.664,1.664.071.532Z" transform="translate(-176.659 -0.05)" fill="#0a0a0a"/>
                                                    <path id="Path_30" data-name="Path 30" d="M96.372,127.54l.973-.973a3.42,3.42,0,1,0,2.14,2.138l-.973.973a2.271,2.271,0,1,1-2.14-2.138Z" transform="translate(-90.474 -123.186)" fill="#0a0a0a"/>
                                                    <path id="Path_31" data-name="Path 31" d="M9.85,37.509a4.514,4.514,0,1,1-2.14-2.14l.93-.93a5.769,5.769,0,1,0,2.138,2.138Z" transform="translate(0 -32.826)" fill="#0a0a0a"/>
                                                </g>
                                            </svg>
                                            <p>Заявки</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['/cabinet/teacher/default/teacher-main-info']);?>" class="dropdown-profile-menu-link">
                                            <svg id="listing-option" xmlns="http://www.w3.org/2000/svg" width="12.447"
                                                 height="9.78" viewBox="0 0 12.447 9.78">
                                                <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
                                                    <path id="Path_40" data-name="Path 40" d="M1.556,164.453H.222a.213.213,0,0,0-.156.066.214.214,0,0,0-.066.156v1.334a.213.213,0,0,0,.066.156.214.214,0,0,0,.156.066H1.556a.225.225,0,0,0,.222-.222v-1.334a.225.225,0,0,0-.222-.222Z" transform="translate(0 -161.786)" fill="#0a0a0a"/>
                                                    <path id="Path_41" data-name="Path 41" d="M1.556,383.722H.222a.213.213,0,0,0-.156.066.214.214,0,0,0-.066.156v1.334a.214.214,0,0,0,.066.156.213.213,0,0,0,.156.066H1.556a.225.225,0,0,0,.222-.222v-1.334a.225.225,0,0,0-.222-.222Z" transform="translate(0 -375.72)" fill="#0a0a0a"/>
                                                    <path id="Path_42" data-name="Path 42" d="M1.556,274.082H.222a.214.214,0,0,0-.156.066A.213.213,0,0,0,0,274.3v1.334a.214.214,0,0,0,.066.156.213.213,0,0,0,.156.066H1.556a.225.225,0,0,0,.222-.222V274.3a.226.226,0,0,0-.222-.222Z" transform="translate(0 -268.747)" fill="#0a0a0a"/>
                                                    <path id="Path_43" data-name="Path 43" d="M1.556,54.817H.222a.213.213,0,0,0-.156.066A.214.214,0,0,0,0,55.039v1.334a.214.214,0,0,0,.066.156.214.214,0,0,0,.156.066H1.556a.225.225,0,0,0,.222-.222V55.039a.225.225,0,0,0-.222-.222Z" transform="translate(0 -54.817)" fill="#0a0a0a"/>
                                                    <path id="Path_44" data-name="Path 44" d="M119.194,383.722h-9.336a.225.225,0,0,0-.222.222v1.334a.225.225,0,0,0,.222.222h9.336a.225.225,0,0,0,.222-.222v-1.334a.225.225,0,0,0-.222-.222Z" transform="translate(-106.969 -375.72)" fill="#0a0a0a"/>
                                                    <path id="Path_45" data-name="Path 45" d="M119.194,274.082h-9.336a.225.225,0,0,0-.222.222v1.334a.225.225,0,0,0,.222.222h9.336a.225.225,0,0,0,.222-.222V274.3a.225.225,0,0,0-.222-.222Z" transform="translate(-106.969 -268.747)" fill="#0a0a0a"/>
                                                    <path id="Path_46" data-name="Path 46" d="M119.35,54.883a.214.214,0,0,0-.156-.066h-9.336a.225.225,0,0,0-.222.222v1.334a.225.225,0,0,0,.222.222h9.336a.225.225,0,0,0,.222-.222V55.039A.214.214,0,0,0,119.35,54.883Z" transform="translate(-106.969 -54.817)" fill="#0a0a0a"/>
                                                    <path id="Path_47" data-name="Path 47" d="M119.194,164.453h-9.336a.225.225,0,0,0-.222.222v1.334a.225.225,0,0,0,.222.222h9.336a.225.225,0,0,0,.222-.222v-1.334a.225.225,0,0,0-.222-.222Z" transform="translate(-106.969 -161.786)" fill="#0a0a0a"/>
                                                </g>
                                            </svg>
                                            <p>Основная информация</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['/cabinet/teacher/default/payment']);?>" class="dropdown-profile-menu-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12.394" height="8.342"
                                                 viewBox="0 0 12.394 8.342">
                                                <g id="credit-card" transform="translate(0)">
                                                    <path id="Path_32" data-name="Path 32" d="M11.32,0H1.072A1.074,1.074,0,0,0,0,1.073V1.43H12.393V1.073A1.074,1.074,0,0,0,11.32,0Zm0,0" transform="translate(0.001)" fill="#0a0a0a"/>
                                                    <path id="Path_33" data-name="Path 33" d="M0,88.617H12.393v.715H0Zm0,0" transform="translate(0 -86.472)" fill="#0a0a0a"/>
                                                    <path id="Path_34" data-name="Path 34" d="M0,151.386a1.074,1.074,0,0,0,1.073,1.073H11.321a1.074,1.074,0,0,0,1.073-1.073v-3.694H0Zm9.176-2.264h.715a.953.953,0,0,1,0,1.907H9.176a.953.953,0,1,1,0-1.907Zm-2.5.6h.715a.358.358,0,0,1,0,.715H6.673a.358.358,0,0,1,0-.715Zm-1.787,0H5.6a.358.358,0,0,1,0,.715H4.886a.358.358,0,0,1,0-.715Zm0,0" transform="translate(0 -144.117)" fill="#0a0a0a"/>
                                                    <path id="Path_35" data-name="Path 35" d="M369.469,236.785h.715a.238.238,0,0,0,0-.477h-.715a.238.238,0,1,0,0,.477Zm0,0" transform="translate(-360.293 -230.589)" fill="#0a0a0a"/>
                                                </g>
                                            </svg>
                                            <p>Услуги и платежи</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['/cabinet/teacher/default/profile']);?>" class="dropdown-profile-menu-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12.283" height="12.283"
                                                 viewBox="0 0 12.283 12.283">
                                                <g id="settings-work-tool" transform="translate(0)">
                                                    <g id="Group_12" data-name="Group 12" transform="translate(0 0)">
                                                        <path id="Path_39" data-name="Path 39" d="M12.247,5.46a.4.4,0,0,0-.395-.3,1.356,1.356,0,0,1-.928-2.36.341.341,0,0,0,.037-.463,6.077,6.077,0,0,0-.973-.983.342.342,0,0,0-.467.038,1.415,1.415,0,0,1-1.532.344A1.364,1.364,0,0,1,7.16.4a.341.341,0,0,0-.3-.359,6.131,6.131,0,0,0-1.382,0,.342.342,0,0,0-.3.351A1.366,1.366,0,0,1,4.332,1.7a1.419,1.419,0,0,1-1.52-.346.342.342,0,0,0-.463-.039,6.1,6.1,0,0,0-.994.982.342.342,0,0,0,.037.467A1.361,1.361,0,0,1,1.735,4.3,1.42,1.42,0,0,1,.4,5.126a.334.334,0,0,0-.355.3,6.152,6.152,0,0,0,0,1.4.406.406,0,0,0,.4.3,1.347,1.347,0,0,1,1.264.842,1.366,1.366,0,0,1-.343,1.519.341.341,0,0,0-.037.463,6.1,6.1,0,0,0,.972.983.342.342,0,0,0,.467-.037A1.413,1.413,0,0,1,4.3,10.55a1.362,1.362,0,0,1,.831,1.333.341.341,0,0,0,.3.359,6.112,6.112,0,0,0,1.382,0,.342.342,0,0,0,.3-.352,1.365,1.365,0,0,1,.84-1.31,1.417,1.417,0,0,1,1.521.346.343.343,0,0,0,.464.039,6.114,6.114,0,0,0,.994-.982A.341.341,0,0,0,10.9,9.52a1.361,1.361,0,0,1-.344-1.532,1.375,1.375,0,0,1,1.256-.833l.076,0a.342.342,0,0,0,.359-.3A6.147,6.147,0,0,0,12.247,5.46ZM6.154,8.2A2.049,2.049,0,1,1,8.2,6.155,2.051,2.051,0,0,1,6.154,8.2Z" transform="translate(-0.003 0)" fill="#0a0a0a" fill-rule="evenodd"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            <p>Настройки</p>
                                        </a>
                                    </li>
                                <?php endif;?>
                                <li><a href="<?=Url::to(['/logout'])?>" class="header-link-logout">Выйти</a></li>
                            </ul>
                        </li>
                        <?php  else: ?>
                            <li>
                                <a href="#courses-login" class="open-popup-courses-login header-auth-links header-is-quest small-vertical-line">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 7.605 10">
                                        <g id="man-user" transform="translate(-1400 -15)">
                                            <path id="Path_19" class="header-icon-svg" data-name="Path 19" d="M106.548,4.891a2.261,2.261,0,0,0,2.013-2.445c0-1.351-.3-2.445-2.013-2.445s-2.013,1.095-2.013,2.445A2.261,2.261,0,0,0,106.548,4.891Z" transform="translate(1297.255 15)"/>
                                            <path id="Path_22" class="header-icon-svg" data-name="Path 22" d="M49.509,181.187c-.037-2.353-.345-3.023-2.7-3.447a1.652,1.652,0,0,1-2.2,0c-2.326.42-2.652,1.08-2.694,3.371,0,.187-.005.2-.006.175,0,.041,0,.116,0,.247,0,0,.56,1.128,3.8,1.128s3.8-1.128,3.8-1.128c0-.084,0-.143,0-.183A1.515,1.515,0,0,1,49.509,181.187Z" transform="translate(1358.092 -157.662)"/>
                                        </g>
                                    </svg>
                                    <p>Вход</p>
                                </a>
                            </li>
                            <li>
                            <a href="<?=Url::to(['/signup'])?>" class="header-auth-links header-is-quest header-signup-link">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11" height="11" viewBox="0 0 9 9"><defs><path id="eddva" class="header-icon-svg" d="M1443.124 18.814a.921.921 0 0 1-.938-.938c0-.532.407-.938.938-.938.532 0 .938.406.938.938a.921.921 0 0 1-.938.938zm-.782-2.814a2.655 2.655 0 0 0-2.657 2.657c0 .313.063.626.156.938l-3.282 3.283v1.563h1.563v-.938h.938v-.937h.938l1.407-1.407c.281.093.594.156.937.156a2.655 2.655 0 0 0 2.658-2.658 2.655 2.655 0 0 0-2.658-2.657z"/></defs><g><g transform="translate(-1436 -16)"><g><use xlink:href="#eddva"/></g></g></g></svg>
                                <p>Регистрация</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="clearfix"></div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-bottom-wrap">
                            <div class="cat-wrap">
                                <div class="con-tooltip bottom bottom-lg-menu" id="con-tooltip">
                                    <div class="cat-wrapper">
                                        <div class="cat-label">Категории</div>
                                        <span class="cat-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="7" viewBox="0 0 13 7"><defs><path id="j67qa" d="M528.194 69.12a.41.41 0 0 0-.58 0l-5.106 5.116-5.116-5.116a.41.41 0 0 0-.581.58l5.396 5.397c.08.08.18.12.29.12.1 0 .21-.04.291-.12l5.396-5.396c.17-.16.17-.42.01-.58z"/></defs><g><g transform="translate(-516 -69)"><use fill="#fff" xlink:href="#j67qa"/></g></g></svg>
                                        </span>
                                    </div>
                                    <div class="tooltip ">
                                        <nav id="mysidebarmenu" class="amazonmenu">
                                            <?= CategoryHelper::CategoriesListLg(); ?>
                                        </nav>
                                    </div>
                                </div>
                                <div id="dl-menu" class="dl-menuwrapper bottom-sm-menu">
                                    <div class="con-tooltip cat-wrapper sm-cat-wrapper dl-trigger">
                                        <div class="cat-label">Категории</div>
                                        <span class="cat-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="7" viewBox="0 0 13 7"><defs><path id="j67qa" d="M528.194 69.12a.41.41 0 0 0-.58 0l-5.106 5.116-5.116-5.116a.41.41 0 0 0-.581.58l5.396 5.397c.08.08.18.12.29.12.1 0 .21-.04.291-.12l5.396-5.396c.17-.16.17-.42.01-.58z"/></defs><g><g transform="translate(-516 -69)"><use fill="#fff" xlink:href="#j67qa"/></g></g></svg>
                                        </span>
                                    </div>
                                    <?= CategoryHelper::CategoriesListSm(); ?>
                                </div>
                            </div>
                            <div class="header-bottom-search-lg">
                                <div class="header-bottom-search-field">
                                    <?= Html::beginForm(['/course/search/search'], 'get', ['class' => '']) ?>
                                        <input type="search" name="text" class="header-search-input" placeholder="Я ищу...">
                                        <button type="submit" class="header-search-btn">
                                            <svg id="search" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 12.396 12.396">
                                                <path id="Path_4" data-name="Path 4" d="M11.324,16.147a4.736,4.736,0,0,0,3.08-1.123l3.743,3.743a.439.439,0,0,0,.62,0,.439.439,0,0,0,0-.62L15.024,14.4a4.816,4.816,0,1,0-3.7,1.743Zm0-8.77a3.947,3.947,0,1,1-3.947,3.947A3.951,3.951,0,0,1,11.324,7.377Z" transform="translate(-6.5 -6.5)"/>
                                            </svg>
                                        </button>
                                    <?= Html::endForm() ?>
                                </div>
                            </div>
                            <div class="header-bottom-icons">
                                <div class="header-bottom-icon header-bottom-sm-wrap">
                                    <a href="#" class="not-active" title="Поиск">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                                <div class="header-bottom-icon">
                                    <a href="#" class="not-active" title="В розработке">
                                        <i class="fa fa-bell"></i>
                                    </a>
                                </div>
                                <div class="header-bottom-icon">
                                    <a href="#" class="not-active" title="В розработке">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                                <div class="header-bottom-icon">
                                    <?php if (!Yii::$app->user->isGuest): ?>
                                        <?php if (UserHelper::getCountsWishlistItems(Yii::$app->user->id) != 0): ?>
                                            <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" class="active-icon" title="Избранные">
                                                <i class="fa fa-heart"></i>
                                                <span><?= UserHelper::getCountsWishlistItems(Yii::$app->user->id); ?></span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" class="not-active" title="Избранные">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php else:?>
                                        <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" class="not-active" title="Избранные">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="header-bottom-search-form-sm">
                                <div class="header-bottom-search-field">
                                    <?= Html::beginForm(['/course/search/search'], 'get', ['class' => '']) ?>
                                        <input type="search" name="text" class="header-search-input" placeholder="Я ищу...">
                                        <button type="submit" class="header-search-btn">
                                            <svg id="search" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 12.396 12.396">
                                                <path id="Path_4" data-name="Path 4" d="M11.324,16.147a4.736,4.736,0,0,0,3.08-1.123l3.743,3.743a.439.439,0,0,0,.62,0,.439.439,0,0,0,0-.62L15.024,14.4a4.816,4.816,0,1,0-3.7,1.743Zm0-8.77a3.947,3.947,0,1,1-3.947,3.947A3.951,3.951,0,0,1,11.324,7.377Z" transform="translate(-6.5 -6.5)"/>
                                            </svg>
                                        </button>
                                    <?= Html::endForm() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <main class="main">
        <div class="bg-hover" id="bg-hover"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                </div>
            </div>
        </div>
        <main class="content">
            <?= $content ?>
        </main>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="footer-top-label">
                            Связаться с нами
                        </div>
                        <div class="footer-top-content">
                            <a href="mailto:teachme.com.ua@gmail.com" class="footer-top-content-item">teachme.com.ua@gmail.com</a>
                        </div>
<!--                        <div class="footer-top-label">-->
<!--                            Связаться с нами-->
<!--                        </div>-->
<!--                        <div class="footer-top-content">-->
<!--                            <a href="tel:0939179871" class="footer-top-content-item">+38 (093) 917 98 71</a>-->
<!--                            <a href="tel:0939179871" class="footer-top-content-item">+38 (093) 917 98 71</a>-->
<!--                        </div>-->
                    </div>
                    <div class="col-sm-3">
                        <div class="footer-top-label">
                            График работы
                        </div>
                        <div class="footer-top-content">
                            <p class="footer-top-content-item">Пн - Пт</p>
                            <p class="footer-top-content-item">с 9:00 по 18:00</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="footer-top-label">
                            Teach Me в соцсетях
                        </div>
                        <div class="footer-top-content footer-top-icons">
                            <div class="footer-top-icon">
                                <a href="#" title="instagram">
                                    <svg id="instagram_2_" data-name="instagram (2)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Group_17" data-name="Group 17" transform="translate(0 0)">
                                            <g id="Group_16" data-name="Group 16">
                                                <path id="Path_62" data-name="Path 62" d="M17.071,2.929A10,10,0,1,0,2.929,17.071,10,10,0,1,0,17.071,2.929ZM10,19.368A9.368,9.368,0,1,1,19.368,10,9.379,9.379,0,0,1,10,19.368Z" transform="translate(0 0)"/>
                                            </g>
                                        </g>
                                        <g id="Group_19" data-name="Group 19" transform="translate(4.232 4.232)">
                                            <g id="Group_18" data-name="Group 18">
                                                <path id="Path_63" data-name="Path 63" d="M106.111,97.011H99.447a2.439,2.439,0,0,0-2.436,2.436v6.664a2.439,2.439,0,0,0,2.436,2.436h6.664a2.439,2.439,0,0,0,2.436-2.436V99.447A2.439,2.439,0,0,0,106.111,97.011Zm1.849,9.1a1.851,1.851,0,0,1-1.849,1.849H99.447a1.851,1.851,0,0,1-1.849-1.849V99.447A1.851,1.851,0,0,1,99.447,97.6h6.664a1.851,1.851,0,0,1,1.849,1.849v6.664Z" transform="translate(-97.011 -97.011)"/>
                                            </g>
                                        </g>
                                        <g id="Group_21" data-name="Group 21" transform="translate(6.969 6.969)">
                                            <g id="Group_20" data-name="Group 20">
                                                <path id="Path_64" data-name="Path 64" d="M178.519,175.321a3.034,3.034,0,1,0-1.426,2.746.291.291,0,0,0,.052-.452l0,0a.292.292,0,0,0-.362-.039,2.429,2.429,0,0,1-1.312.367,2.447,2.447,0,1,1,2.186-1.3.292.292,0,0,0,.049.344l0,0a.29.29,0,0,0,.46-.066A3.012,3.012,0,0,0,178.519,175.321Z" transform="translate(-172.463 -172.464)"/>
                                            </g>
                                        </g>
                                        <g id="Group_23" data-name="Group 23" transform="translate(12.608 5.404)">
                                            <g id="Group_22" data-name="Group 22">
                                                <circle id="Ellipse_6" data-name="Ellipse 6" cx="0.782" cy="0.782" r="0.782"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="footer-top-icon">
                                <a href="#" title="facebook">
                                    <svg id="facebook_2_" data-name="facebook (2)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Group_30" data-name="Group 30" transform="translate(0 0)">
                                            <path id="Path_68" data-name="Path 68" d="M17.072,2.929A10,10,0,1,0,6.523,19.378a.316.316,0,0,0,.362-.106.327.327,0,0,0,.064-.2v-5.7a.316.316,0,0,0-.316-.316H4V10.737H6.633a.316.316,0,0,0,.316-.316V10a5.522,5.522,0,0,1,5.579-5.158H13.9V7.158H12.527a3.643,3.643,0,0,0-2.282.722A2.621,2.621,0,0,0,9.264,10v.421a.316.316,0,0,0,.316.316h1.245a.316.316,0,0,0,0-.632H9.9V10c0-1.632,1.418-2.211,2.632-2.211h1.684a.316.316,0,0,0,.316-.316V4.526a.316.316,0,0,0-.316-.316H12.527A6.5,6.5,0,0,0,8.235,5.9,5.526,5.526,0,0,0,6.317,10v.105H3.685a.316.316,0,0,0-.316.316v2.947a.316.316,0,0,0,.316.316H6.317v4.932A9.373,9.373,0,1,1,10,19.368H9.9V13.684h4.316a.316.316,0,0,0,.316-.316V10.421a.316.316,0,0,0-.316-.316H12.363a.316.316,0,0,0,0,.632H13.9v2.316H9.58a.316.316,0,0,0-.316.316v6.306a.316.316,0,0,0,.3.316c.156.007.3.01.435.01A10,10,0,0,0,17.072,2.929Z" transform="translate(-0.001 0)"/>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="footer-top-icon">
                                <a href="#" title="telegram">
                                    <svg id="telegram_1_" data-name="telegram (1)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Group_25" data-name="Group 25" transform="translate(0 0)">
                                            <g id="Group_24" data-name="Group 24">
                                                <path id="Path_65" data-name="Path 65" d="M17.071,2.929A10,10,0,1,0,2.929,17.071,10,10,0,1,0,17.071,2.929ZM10,19.368A9.368,9.368,0,1,1,19.368,10,9.379,9.379,0,0,1,10,19.368Z" transform="translate(0 0)" />
                                            </g>
                                        </g>
                                        <g id="Group_27" data-name="Group 27" transform="translate(2.426 3.945)">
                                            <g id="Group_26" data-name="Group 26">
                                                <path id="Path_66" data-name="Path 66" d="M87.818,97.073a.307.307,0,0,0-.326-.027l-11.875,6.142a.307.307,0,0,0,0,.548l3.106,1.553v3.077a.317.317,0,0,0,.083.219.307.307,0,0,0,.374.058l3.554-1.974,2.72,1.166a.32.32,0,0,0,.184.024.308.308,0,0,0,.246-.242l.688-3.441a.307.307,0,0,0-.6-.121l-.614,3.07-2.519-1.079a.307.307,0,0,0-.27.014l-3.229,1.794V105.1a.307.307,0,0,0-.17-.275l-2.736-1.368,10.771-5.571-.935,4.674a.307.307,0,0,0,.6.12l1.06-5.3A.307.307,0,0,0,87.818,97.073Z" transform="translate(-75.451 -97.011)"/>
                                            </g>
                                        </g>
                                        <g id="Group_29" data-name="Group 29" transform="translate(7.67 6.417)">
                                            <g id="Group_28" data-name="Group 28">
                                                <path id="Path_67" data-name="Path 67" d="M199.894,161.8a.307.307,0,0,0-.4-.071l-5.323,3.276a.307.307,0,0,0-.146.262v3.276a.307.307,0,0,0,.582.137l1.206-2.412,4.06-4.06A.307.307,0,0,0,199.894,161.8Zm-4.553,4.068a.307.307,0,0,0-.058.08l-.647,1.293v-1.8l2.949-1.815Z" transform="translate(-194.022 -161.683)"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="footer-top-icon">
                                <a href="#" title="whatsapp">
                                    <svg id="whatsapp" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Group_32" data-name="Group 32" transform="translate(0 0)">
                                            <g id="Group_31" data-name="Group 31">
                                                <path id="Path_69" data-name="Path 69" d="M17.071,2.929A10,10,0,1,0,2.929,17.071,10,10,0,1,0,17.071,2.929ZM10,19.368A9.368,9.368,0,1,1,19.368,10,9.379,9.379,0,0,1,10,19.368Z" transform="translate(0 0)"/>
                                            </g>
                                        </g>
                                        <g id="Group_34" data-name="Group 34" transform="translate(3.839 2.839)">
                                            <g id="Group_33" data-name="Group 33">
                                                <path id="Path_70" data-name="Path 70" d="M86.817,78.784a.251.251,0,0,0-.423-.052l0,0a.358.358,0,0,0-.036.4,7.269,7.269,0,0,1,.869,3.481c0,3.595-2.516,6.519-5.609,6.519a5.178,5.178,0,0,1-3.707-1.628.258.258,0,0,0-.184-.082H76.136l.521-1.514a.368.368,0,0,0-.012-.268A7.4,7.4,0,0,1,76,82.614c0-3.595,2.516-6.519,5.609-6.519a5.224,5.224,0,0,1,3.933,1.876.247.247,0,0,0,.384,0l0,0a.356.356,0,0,0,0-.452,5.737,5.737,0,0,0-4.318-2.059c-3.4,0-6.161,3.212-6.161,7.161a8.152,8.152,0,0,0,.645,3.193l-.626,1.818A.355.355,0,0,0,75.56,88a.259.259,0,0,0,.176.067h1.883a5.671,5.671,0,0,0,3.995,1.71c3.4,0,6.161-3.212,6.161-7.161A7.983,7.983,0,0,0,86.817,78.784Z" transform="translate(-75.453 -75.453)"/>
                                            </g>
                                        </g>
                                        <g id="Group_36" data-name="Group 36" transform="translate(5.997 5.628)">
                                            <g id="Group_35" data-name="Group 35">
                                                <path id="Path_71" data-name="Path 71" d="M157.676,146.053a.316.316,0,0,0-.071-.1l-1.716-1.716a.3.3,0,0,0-.43,0l-.724.724a3.088,3.088,0,0,1-1.864-1.864l.724-.724a.3.3,0,0,0,0-.43l-1.721-1.721a.3.3,0,0,0-.43,0l-1.765,1.765a1.2,1.2,0,0,0-.129,1.548,20.814,20.814,0,0,0,2.438,2.818.3.3,0,0,0,.423,0l0,0a.3.3,0,0,0,0-.429,20.216,20.216,0,0,1-2.369-2.737.589.589,0,0,1,.065-.762l1.549-1.549,1.291,1.291-.645.645a.3.3,0,0,0-.074.31,3.753,3.753,0,0,0,2.487,2.488.3.3,0,0,0,.311-.074l.645-.645,1.291,1.291-1.55,1.549a.588.588,0,0,1-.762.065q-.6-.43-1.159-.9a.3.3,0,0,0-.4.019l0,0a.3.3,0,0,0,.02.444q.578.483,1.193.926a1.194,1.194,0,0,0,1.548-.129l1.765-1.765A.305.305,0,0,0,157.676,146.053Z" transform="translate(-149.324 -140.128)"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="footer-card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="113.25" height="25.76" viewBox="0 0 113.25 25.76">
                                <g id="Group_73" data-name="Group 73" transform="translate(-1389 -2935)">
                                    <g id="Group_72" data-name="Group 72">
                                        <g id="visa" transform="translate(1389 2939.824)">
                                            <path id="Path_97" data-name="Path 97" d="M184.8,195.585l2.7-15.185h4.218L189.1,195.585Z" transform="translate(-165.313 -179.894)" fill="#3c58bf"/>
                                            <path id="Path_98" data-name="Path 98" d="M184.8,195.585l3.459-15.185h3.459L189.1,195.585Z" transform="translate(-165.313 -179.894)" fill="#293688"/>
                                            <path id="Path_99" data-name="Path 99" d="M260.907,176.275a10.7,10.7,0,0,0-3.881-.675c-4.218,0-7.255,2.109-7.255,5.146,0,2.278,2.109,3.459,3.8,4.218s2.193,1.265,2.193,1.94c0,1.012-1.35,1.518-2.531,1.518a9.17,9.17,0,0,1-4.049-.844l-.591-.253L248,190.785a13.679,13.679,0,0,0,4.809.844c4.471,0,7.424-2.109,7.424-5.315,0-1.772-1.1-3.121-3.628-4.218-1.518-.759-2.446-1.181-2.446-1.94,0-.675.759-1.35,2.446-1.35a7.738,7.738,0,0,1,3.206.59l.422.169.675-3.29Z" transform="translate(-221.848 -175.6)" fill="#3c58bf"/>
                                            <path id="Path_100" data-name="Path 100" d="M260.907,176.275a10.7,10.7,0,0,0-3.881-.675c-4.218,0-6.5,2.109-6.5,5.146,0,2.278,1.35,3.459,3.037,4.218s2.193,1.265,2.193,1.94c0,1.012-1.35,1.518-2.531,1.518a9.17,9.17,0,0,1-4.049-.844l-.591-.253L248,190.785a13.679,13.679,0,0,0,4.809.844c4.471,0,7.424-2.109,7.424-5.315,0-1.772-1.1-3.121-3.628-4.218-1.518-.759-2.446-1.181-2.446-1.94,0-.675.759-1.35,2.446-1.35a7.738,7.738,0,0,1,3.206.59l.422.169.675-3.29Z" transform="translate(-221.848 -175.6)" fill="#293688"/>
                                            <path id="Path_101" data-name="Path 101" d="M366.92,180.4c-1.012,0-1.772.084-2.193,1.1L358.4,195.585h4.555l.844-2.531h5.4l.506,2.531h4.049L370.211,180.4Zm-1.94,10.123c.253-.759,1.687-4.471,1.687-4.471s.337-.928.59-1.518l.253,1.434s.844,3.8,1.012,4.64H364.98Z" transform="translate(-320.606 -179.894)" fill="#3c58bf"/>
                                            <path id="Path_102" data-name="Path 102" d="M367.933,180.4c-1.012,0-1.772.084-2.193,1.1L358.4,195.585h4.556l.844-2.531h5.4l.506,2.531h4.049L370.211,180.4Zm-2.953,10.123c.337-.844,1.687-4.471,1.687-4.471s.337-.928.59-1.518l.253,1.434s.844,3.8,1.012,4.64H364.98Z" transform="translate(-320.606 -179.894)" fill="#293688"/>
                                            <path id="Path_103" data-name="Path 103" d="M57.527,191.745l-.422-2.193a12.229,12.229,0,0,0-5.905-6.664l3.8,13.5h4.555L66.385,181.2H61.829Z" transform="translate(-45.801 -180.609)" fill="#3c58bf"/>
                                            <path id="Path_104" data-name="Path 104" d="M57.527,191.745l-.422-2.193a12.229,12.229,0,0,0-5.905-6.664l3.8,13.5h4.555L66.385,181.2H62.673Z" transform="translate(-45.801 -180.609)" fill="#293688"/>
                                            <path id="Path_105" data-name="Path 105" d="M0,180.4l.759.169c5.4,1.265,9.111,4.471,10.545,8.267l-1.518-7.171c-.253-1.012-1.012-1.265-1.94-1.265Z" transform="translate(0 -179.894)" fill="#ffbc00"/>
                                            <path id="Path_106" data-name="Path 106" d="M0,180.4H0c5.4,1.265,9.87,4.555,11.3,8.352l-1.434-5.99a2.059,2.059,0,0,0-2.025-1.6Z" transform="translate(0 -179.894)" fill="#f7981d"/>
                                            <path id="Path_107" data-name="Path 107" d="M0,180.4H0c5.4,1.265,9.87,4.555,11.3,8.352l-1.012-3.29a2.975,2.975,0,0,0-1.772-2.446Z" transform="translate(0 -179.894)" fill="#ed7c00"/>
                                            <g id="Group_67" data-name="Group 67" transform="translate(5.483 2.193)">
                                                <path id="Path_108" data-name="Path 108" d="M62.461,204.836l-2.868-2.868-1.35,3.206-.337-2.109A12.229,12.229,0,0,0,52,196.4l3.8,13.5h4.556Z" transform="translate(-52 -196.4)" fill="#051244"/>
                                                <path id="Path_109" data-name="Path 109" d="M189.1,292.912l-3.628-3.712-.675,3.712Z" transform="translate(-170.796 -279.414)" fill="#051244"/>
                                                <path id="Path_110" data-name="Path 110" d="M255.339,274.8h0c.337.337.506.591.422.928,0,1.012-1.35,1.518-2.531,1.518a9.17,9.17,0,0,1-4.049-.844l-.591-.253L248,279.608a13.68,13.68,0,0,0,4.809.844c2.7,0,4.893-.759,6.158-2.109Z" transform="translate(-227.332 -266.533)" fill="#051244"/>
                                                <path id="Path_111" data-name="Path 111" d="M364,230.651h3.965l.844-2.531h5.4l.506,2.531h4.049l-1.434-6.158-5.062-4.893.253,1.35s.844,3.8,1.012,4.64H369.99c.337-.844,1.687-4.471,1.687-4.471s.337-.928.591-1.519" transform="translate(-331.099 -217.154)" fill="#051244"/>
                                            </g>
                                        </g>
                                        <g id="mastercard" transform="translate(1459.315 2935)">
                                            <path id="Path_112" data-name="Path 112" d="M227.361,113.68a12.88,12.88,0,0,1-25.761,0h0a12.88,12.88,0,1,1,25.761,0Z" transform="translate(-184.426 -100.8)" fill="#ffb600"/>
                                            <path id="Path_113" data-name="Path 113" d="M214.48,100.8a12.914,12.914,0,0,1,12.88,12.88h0a12.88,12.88,0,0,1-25.761,0" transform="translate(-184.426 -100.8)" fill="#f7981d"/>
                                            <path id="Path_114" data-name="Path 114" d="M352.8,100.8a12.914,12.914,0,0,1,12.88,12.88h0a12.87,12.87,0,0,1-12.88,12.88" transform="translate(-322.746 -100.8)" fill="#ff8500"/>
                                            <path id="Path_115" data-name="Path 115" d="M12.744,100.8a12.881,12.881,0,0,0,.136,25.76,13.03,13.03,0,0,0,8.655-3.339h0a12.248,12.248,0,0,0,1.295-1.363H20.172a15.725,15.725,0,0,1-.954-1.295h4.566a8.73,8.73,0,0,0,.75-1.363H18.469a8.123,8.123,0,0,1-.545-1.363h7.088a13.532,13.532,0,0,0,.682-4.089,17.59,17.59,0,0,0-.273-2.726H17.515a9.964,9.964,0,0,1,.341-1.363h7.088A8.122,8.122,0,0,0,24.4,108.3h-6a13.511,13.511,0,0,1,.75-1.363h4.566a6.481,6.481,0,0,0-1.022-1.363H20.172a11.618,11.618,0,0,1,1.295-1.295,12.576,12.576,0,0,0-8.655-3.339C12.812,100.8,12.812,100.8,12.744,100.8Z" transform="translate(0 -100.8)" fill="#ff5050"/>
                                            <path id="Path_116" data-name="Path 116" d="M0,115.144a12.87,12.87,0,0,0,12.88,12.88,13.03,13.03,0,0,0,8.655-3.339h0a12.246,12.246,0,0,0,1.295-1.363H20.172a15.721,15.721,0,0,1-.954-1.295h4.566a8.73,8.73,0,0,0,.75-1.363H18.469a8.123,8.123,0,0,1-.545-1.363h7.088a13.532,13.532,0,0,0,.682-4.089,17.59,17.59,0,0,0-.273-2.726H17.515a9.962,9.962,0,0,1,.341-1.363h7.088a8.122,8.122,0,0,0-.545-1.363h-6a13.513,13.513,0,0,1,.75-1.363h4.566a6.481,6.481,0,0,0-1.022-1.363H20.172a11.618,11.618,0,0,1,1.295-1.295,12.576,12.576,0,0,0-8.655-3.339h-.068" transform="translate(0 -102.264)" fill="#e52836"/>
                                            <path id="Path_117" data-name="Path 117" d="M149.736,128.024a13.03,13.03,0,0,0,8.655-3.339h0a12.249,12.249,0,0,0,1.295-1.363h-2.658a15.718,15.718,0,0,1-.954-1.295h4.566a8.73,8.73,0,0,0,.75-1.363h-6.065a8.124,8.124,0,0,1-.545-1.363h7.088a13.531,13.531,0,0,0,.682-4.089,17.594,17.594,0,0,0-.273-2.726H154.37a9.959,9.959,0,0,1,.341-1.363H161.8a8.122,8.122,0,0,0-.545-1.363h-6a13.512,13.512,0,0,1,.75-1.363h4.566a6.481,6.481,0,0,0-1.022-1.363h-2.522a11.618,11.618,0,0,1,1.295-1.295,12.576,12.576,0,0,0-8.655-3.339H149.6" transform="translate(-136.856 -102.264)" fill="#cb2026"/>
                                            <g id="Group_68" data-name="Group 68" transform="translate(1.227 9.541)">
                                                <path id="Path_118" data-name="Path 118" d="M183.576,226l.2-1.159a2.952,2.952,0,0,1-.341.068c-.477,0-.545-.273-.477-.409l.409-2.385h.75l.2-1.295h-.682l.136-.818h-1.363s-.818,4.5-.818,5.043a1.023,1.023,0,0,0,1.09,1.159A2.092,2.092,0,0,0,183.576,226Z" transform="translate(-167.357 -219.387)" fill="#fff"/>
                                                <path id="Path_119" data-name="Path 119" d="M210.4,231.774a2.168,2.168,0,0,0,2.385,2.385,3.539,3.539,0,0,0,1.431-.2l.273-1.295a4.086,4.086,0,0,1-1.431.341c-1.5,0-1.227-1.09-1.227-1.09h2.794a8.837,8.837,0,0,0,.2-1.227,1.846,1.846,0,0,0-1.976-1.976C211.422,228.571,210.4,230.07,210.4,231.774Zm2.385-1.976c.75,0,.613.886.613.954h-1.5C211.9,230.684,212.036,229.8,212.785,229.8Z" transform="translate(-193.703 -227.344)" fill="#fff"/>
                                                <path id="Path_120" data-name="Path 120" d="M299.748,219.41l.273-1.5a3.349,3.349,0,0,1-1.159.341c-.954,0-1.363-.75-1.363-1.567,0-1.636.818-2.522,1.772-2.522a2.276,2.276,0,0,1,1.227.409l.2-1.431a4.792,4.792,0,0,0-1.567-.341c-1.567,0-3.135,1.363-3.135,3.953,0,1.7.818,2.862,2.453,2.862A6.115,6.115,0,0,0,299.748,219.41Z" transform="translate(-272.011 -212.8)" fill="#fff"/>
                                                <path id="Path_121" data-name="Path 121" d="M88.99,227.2a4.827,4.827,0,0,0-1.636.273l-.2,1.159a4.028,4.028,0,0,1,1.5-.273c.477,0,.886.068.886.477,0,.273-.068.341-.068.341h-.613c-1.159,0-2.453.477-2.453,2.044,0,1.227.818,1.5,1.295,1.5a2.048,2.048,0,0,0,1.431-.613l-.068.545h1.227l.545-3.748A1.615,1.615,0,0,0,88.99,227.2Zm.273,3.067c0,.2-.136,1.295-.954,1.295a.532.532,0,0,1-.545-.545c0-.341.2-.818,1.227-.818A1.074,1.074,0,0,0,89.262,230.267Z" transform="translate(-80.266 -225.973)" fill="#fff"/>
                                                <path id="Path_122" data-name="Path 122" d="M136.767,231.988a1.747,1.747,0,0,0,2.045-1.772c0-1.7-1.636-1.363-1.636-2.044,0-.341.273-.477.75-.477.2,0,.954.068.954.068l.2-1.227a5.178,5.178,0,0,0-1.295-.136c-1.022,0-2.044.409-2.044,1.772,0,1.567,1.7,1.431,1.7,2.044,0,.409-.477.477-.818.477a4.457,4.457,0,0,1-1.227-.2l-.2,1.227C135.268,231.852,135.609,231.988,136.767,231.988Z" transform="translate(-124.909 -225.241)" fill="#fff"/>
                                                <path id="Path_123" data-name="Path 123" d="M431.085,214.4l-.273,1.84a1.89,1.89,0,0,0-1.295-.682c-1.227,0-2.317,1.5-2.317,3.271,0,1.09.545,2.249,1.7,2.249a1.819,1.819,0,0,0,1.295-.545l-.068.477h1.363l1.022-6.542Zm-.613,3.612c0,.75-.341,1.7-1.09,1.7-.477,0-.75-.409-.75-1.09,0-1.09.477-1.772,1.09-1.772C430.2,216.853,430.471,217.194,430.471,218.012Z" transform="translate(-392.035 -214.264)" fill="#fff"/>
                                                <path id="Path_124" data-name="Path 124" d="M15.695,220.942l.818-4.907.136,4.907H17.6l1.772-4.907-.75,4.907h1.431l1.09-6.542H18.9l-1.363,4.021-.068-4.021H15.49l-1.09,6.542Z" transform="translate(-14.4 -214.264)" fill="#fff"/>
                                                <path id="Path_125" data-name="Path 125" d="M261.5,234.116c.409-2.249.477-4.089,1.431-3.748a5.353,5.353,0,0,1,.477-1.567h-.273c-.613,0-1.09.818-1.09.818l.136-.75h-1.295L260,234.184h1.5Z" transform="translate(-239.078 -227.437)" fill="#fff"/>
                                                <path id="Path_126" data-name="Path 126" d="M348.99,227.2a4.827,4.827,0,0,0-1.636.273l-.2,1.159a4.028,4.028,0,0,1,1.5-.273c.477,0,.886.068.886.477,0,.273-.068.341-.068.341h-.613c-1.159,0-2.453.477-2.453,2.044,0,1.227.818,1.5,1.295,1.5a2.047,2.047,0,0,0,1.431-.613l-.068.545h1.227l.545-3.748A1.591,1.591,0,0,0,348.99,227.2Zm.341,3.067c0,.2-.136,1.295-.954,1.295a.532.532,0,0,1-.545-.545c0-.341.2-.818,1.227-.818C349.262,230.267,349.262,230.267,349.33,230.267Z" transform="translate(-318.118 -225.973)" fill="#fff"/>
                                                <path id="Path_127" data-name="Path 127" d="M395.9,234.116c.409-2.249.477-4.089,1.431-3.748a5.351,5.351,0,0,1,.477-1.567h-.273c-.613,0-1.09.818-1.09.818l.136-.75h-1.295l-.886,5.316h1.5Z" transform="translate(-362.029 -227.437)" fill="#fff"/>
                                            </g>
                                            <g id="Group_69" data-name="Group 69" transform="translate(1.227 9.541)">
                                                <path id="Path_128" data-name="Path 128" d="M180,225.043a1.023,1.023,0,0,0,1.09,1.159,2.6,2.6,0,0,0,1.022-.2l.2-1.159a2.951,2.951,0,0,1-.341.068c-.477,0-.545-.273-.477-.409l.409-2.385h.75l.2-1.295h-.682l.136-.818" transform="translate(-165.893 -219.387)" fill="#dce5e5"/>
                                                <path id="Path_129" data-name="Path 129" d="M218.4,231.774c0,1.908.613,2.385,1.7,2.385a3.539,3.539,0,0,0,1.431-.2l.273-1.295a4.085,4.085,0,0,1-1.431.341c-1.5,0-1.227-1.09-1.227-1.09h2.794a8.835,8.835,0,0,0,.2-1.227,1.846,1.846,0,0,0-1.976-1.976C218.741,228.571,218.4,230.07,218.4,231.774Zm1.7-1.976c.75,0,.886.886.886.954h-1.772C219.218,230.684,219.354,229.8,220.1,229.8Z" transform="translate(-201.022 -227.344)" fill="#dce5e5"/>
                                                <path id="Path_130" data-name="Path 130" d="M307.067,219.41l.273-1.5a3.349,3.349,0,0,1-1.159.341c-.954,0-1.363-.75-1.363-1.567,0-1.636.818-2.522,1.772-2.522a2.276,2.276,0,0,1,1.227.409l.2-1.431a4.792,4.792,0,0,0-1.567-.341c-1.567,0-2.453,1.363-2.453,3.953,0,1.7.136,2.862,1.772,2.862A6.116,6.116,0,0,0,307.067,219.41Z" transform="translate(-279.33 -212.8)" fill="#dce5e5"/>
                                                <path id="Path_131" data-name="Path 131" d="M87.15,230.163a4.029,4.029,0,0,1,1.5-.273c.477,0,.886.068.886.477,0,.273-.068.341-.068.341h-.613c-1.159,0-2.453.477-2.453,2.044,0,1.227.818,1.5,1.295,1.5a2.048,2.048,0,0,0,1.431-.613l-.068.545h1.227l.545-3.748c0-1.567-1.363-1.636-1.908-1.636m1.022,2.93a2.231,2.231,0,0,1-1.636,1.295.532.532,0,0,1-.545-.545c0-.341.2-.818,1.227-.818A5.568,5.568,0,0,0,89.944,231.73Z" transform="translate(-80.266 -227.437)" fill="#dce5e5"/>
                                                <path id="Path_132" data-name="Path 132" d="M136,231.852a5.768,5.768,0,0,0,1.567.136,1.747,1.747,0,0,0,2.045-1.772c0-1.7-1.636-1.363-1.636-2.044,0-.341.273-.477.75-.477.2,0,.954.068.954.068l.2-1.227a5.178,5.178,0,0,0-1.295-.136c-1.022,0-1.363.409-1.363,1.772,0,1.567,1.022,1.431,1.022,2.044,0,.409-.477.477-.818.477" transform="translate(-125.641 -225.241)" fill="#dce5e5"/>
                                                <path id="Path_133" data-name="Path 133" d="M438.077,216.972a1.889,1.889,0,0,0-1.295-.682c-1.227,0-1.636,1.5-1.636,3.271,0,1.09-.136,2.249,1.022,2.249a1.819,1.819,0,0,0,1.295-.545l-.068.477h1.363l1.022-6.542m-1.772,3.544c0,.75-.613,1.7-1.363,1.7-.477,0-.75-.409-.75-1.09,0-1.09.477-1.772,1.09-1.772A1.041,1.041,0,0,1,438.009,218.744Z" transform="translate(-399.3 -214.996)" fill="#dce5e5"/>
                                                <path id="Path_134" data-name="Path 134" d="M15.695,220.942l.818-4.907.136,4.907H17.6l1.772-4.907-.75,4.907h1.431l1.09-6.542h-1.7l-1.908,4.021-.068-4.021h-.75L14.4,220.942Z" transform="translate(-14.4 -214.264)" fill="#dce5e5"/>
                                                <path id="Path_135" data-name="Path 135" d="M260.8,234.116h1.431c.409-2.249.477-4.089,1.431-3.748a5.35,5.35,0,0,1,.477-1.567h-.273c-.613,0-1.09.818-1.09.818l.136-.75" transform="translate(-239.81 -227.437)" fill="#dce5e5"/>
                                                <path id="Path_136" data-name="Path 136" d="M347.15,230.163a4.028,4.028,0,0,1,1.5-.273c.477,0,.886.068.886.477,0,.273-.068.341-.068.341h-.613c-1.159,0-2.453.477-2.453,2.044,0,1.227.818,1.5,1.295,1.5a2.048,2.048,0,0,0,1.431-.613l-.068.545h1.227l.545-3.748c0-1.567-1.363-1.636-1.908-1.636m1.022,2.93a2.231,2.231,0,0,1-1.636,1.295.532.532,0,0,1-.545-.545c0-.341.2-.818,1.227-.818A6,6,0,0,0,349.944,231.73Z" transform="translate(-318.118 -227.437)" fill="#dce5e5"/>
                                                <path id="Path_137" data-name="Path 137" d="M395.2,234.116h1.431c.409-2.249.477-4.089,1.431-3.748a5.35,5.35,0,0,1,.477-1.567h-.273c-.613,0-1.09.818-1.09.818l.136-.75" transform="translate(-362.761 -227.437)" fill="#dce5e5"/>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container footer-bottom-wrap">
                <div class="logo-footer">
                    <a href="#">
                        <img src="<?= Url::base() ?>/img/logo-small.png" alt="logo">
                    </a>
                </div>
                <div class="footer-bottom-content">
                    <div class="left-text">
                        <a href="#">
                            © 2018 Teach Me
                        </a>

                    </div>
                    <div class="right-text">
                        <a href="#">
                            by Iceberg Studio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endContent() ?>


