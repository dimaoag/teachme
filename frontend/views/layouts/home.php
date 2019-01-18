<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\helpers\Url;
use shop\helpers\UserHelper;
use yii\widgets\Breadcrumbs;


?>

<?php $this->beginContent('@frontend/views/layouts/layout.php') ?>
<header>
    <nav class="navbar navbar-default header-top">
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

