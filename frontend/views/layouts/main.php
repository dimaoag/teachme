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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="107" height="21" viewBox="0 0 107 21"><defs><path id="1jfoa" d="M473.18 11.361l-.756 2.82s3.005-.402 5.402.24c2.397.643 4.8 2.493 4.8 2.493l.766-2.858s-2.214-2.056-4.776-2.742c-2.56-.687-5.437.047-5.437.047z"/><path id="1jfob" d="M485.816 13.968a.444.444 0 1 1 .23-.859.444.444 0 0 1-.23.86zm.6-1.516l-.072.267-.455-.44c.23-.077.618-.165.527.173zm.009 1.739l1.16-.274-.863-.833.071-.267s.674-1.372-1.153-1.05c-.094.024-.15.057-.18.097l-5.7-5.507-10.147 2.678 2.918 2.4.131-.49s3.207-.819 6.064-.053c2.856.765 5.324 3.057 5.324 3.057l-.23.855 2.099-.494-1.069 3.989-.61-.164-.38 1.418.962-.344.75.803.38-1.418-.66-.177 1.133-4.226z"/></defs><g><g transform="translate(-381 -6)"><g><g><text fill="#fff" style="line-height:81.05730438232422px;font-kerning:normal" dominant-baseline="text-before-edge" font-family="'Intro','Intro'" font-size="18.7"  font-weight="400" letter-spacing=".75" transform="translate(381 13)"><tspan fill="#9e3ffc">teach </tspan><tspan>me</tspan></text></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#1jfoa"/></g><g><use fill="#9e3ffc" xlink:href="#1jfob"/></g></g></g></g></g></svg>
                    </a>
                    <a class="navbar-brand logo-small" href="<?=Url::home()?>">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="23" viewBox="0 0 35 23"><defs><path id="jmk8a" d="M36.18 12.361l-.756 2.82s3.005-.402 5.402.24c2.397.643 4.8 2.493 4.8 2.493l.766-2.858S44.178 13 41.616 12.314c-2.56-.687-5.437.047-5.437.047z"/><path id="jmk8b" d="M48.816 14.968a.444.444 0 1 1 .23-.859.444.444 0 0 1-.23.86zm.6-1.516l-.072.267-.455-.44c.23-.077.618-.165.527.173zm.009 1.739l1.16-.274-.863-.833.071-.267s.674-1.372-1.153-1.05c-.094.024-.15.057-.18.097l-5.7-5.507-10.147 2.678 2.918 2.4.131-.49s3.207-.819 6.064-.053c2.856.765 5.324 3.057 5.324 3.057l-.23.855 2.099-.494L47.85 19.3l-.61-.164-.38 1.418.962-.344.75.803.38-1.418-.66-.177 1.133-4.226z"/></defs><g><g transform="translate(-16 -7)"><g><g><text fill="#fff" style="line-height:81.05730438232422px;font-kerning:normal" dominant-baseline="text-before-edge" font-family="'Intro','Intro'" font-size="18.7"  font-weight="400" letter-spacing=".75" transform="translate(16 16)"><tspan fill="#9e3ffc">t</tspan><tspan>m</tspan></text></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#jmk8a"/></g><g><use fill="#9e3ffc" xlink:href="#jmk8b"/></g></g></g></g></g></svg>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="<?=Url::home()?>">Главная</a></li>
                        <li><a href="<?=Url::to(['/course/search/search'])?>">Курсы</a></li>
                        <li><a href="<?=Url::to(['/course/search/search'])?>">Мастер-класы</a></li>
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
                            <a href="tel:0939179871" class="footer-top-content-item">+38 (093) 917 98 71</a>
                            <a href="tel:0939179871" class="footer-top-content-item">+38 (093) 917 98 71</a>
                        </div>
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
                            Связаться с нами
                        </div>
                        <div class="footer-top-content">
                            <a href="mailto:teachme.com.ua@gmail.com" class="footer-top-content-item">teachme.com.ua@gmail.com</a>
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
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container footer-bottom-wrap">
                <div class="logo-footer">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="23" viewBox="0 0 35 23"><defs><path id="jmk8a" d="M36.18 12.361l-.756 2.82s3.005-.402 5.402.24c2.397.643 4.8 2.493 4.8 2.493l.766-2.858S44.178 13 41.616 12.314c-2.56-.687-5.437.047-5.437.047z"/><path id="jmk8b" d="M48.816 14.968a.444.444 0 1 1 .23-.859.444.444 0 0 1-.23.86zm.6-1.516l-.072.267-.455-.44c.23-.077.618-.165.527.173zm.009 1.739l1.16-.274-.863-.833.071-.267s.674-1.372-1.153-1.05c-.094.024-.15.057-.18.097l-5.7-5.507-10.147 2.678 2.918 2.4.131-.49s3.207-.819 6.064-.053c2.856.765 5.324 3.057 5.324 3.057l-.23.855 2.099-.494L47.85 19.3l-.61-.164-.38 1.418.962-.344.75.803.38-1.418-.66-.177 1.133-4.226z"/></defs><g><g transform="translate(-16 -7)"><g><g><text fill="#fff" style="line-height:81.05730438232422px;font-kerning:normal" dominant-baseline="text-before-edge" font-family="'Intro','Intro'" font-size="18.7" font-weight="400" letter-spacing=".75" transform="translate(16 16)"><tspan fill="#9e3ffc">t</tspan><tspan>m</tspan></text></g></g><g><g><g><use fill="#9e3ffc" xlink:href="#jmk8a"/></g><g><use fill="#9e3ffc" xlink:href="#jmk8b"/></g></g></g></g></g></svg>
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


