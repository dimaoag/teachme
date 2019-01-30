<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->first_name;?> <?= Yii::$app->user->identity->last_name;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
//                            ['label' => 'Все пользователи', 'icon' => 'users', 'url' => ['/user'], 'active' => $this->context->route == 'user/index'],
//                            ['label' => 'Публикации', 'icon' => 'cubes', 'url' => ['/user/publications'], 'activeOnRoutes'=> ['/user/publications']],
                            ['label' => 'Все пользователи', 'icon' => 'users', 'url' => ['user/user'], 'active' => $this->context->id == 'user/user'],
                            ['label' => 'Публикации', 'icon' => 'cubes', 'url' => ['user/publication'], 'active' => $this->context->id == 'user/publication'],
                            ['label' => 'Платежи', 'icon' => 'money', 'url' => ['/user/payment'], 'active' => $this->context->id == 'user/payment'],
                            ['label' => 'Заявки', 'icon' => 'globe', 'url' => ['/user/order'], 'active' => $this->context->id == 'user/order'],
                        ],
                    ],
                    [
                        'label' => 'Курс',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Категории', 'icon' => 'reorder', 'url' => ['/course/category/index'], 'active' => $this->context->id == 'course/category'],
                            ['label' => 'Города', 'icon' => 'location-arrow', 'url' => ['/course/city/index'], 'active' => $this->context->id == 'course/city'],
                            ['label' => 'Характеристики', 'icon' => 'cubes', 'url' => ['/course/characteristic/index'], 'active' => $this->context->id == 'course/characteristic'],
                            ['label' => 'Типы курсов', 'icon' => 'ticket', 'url' => ['/course/course-type/index'], 'active' => $this->context->id == 'course/course-type'],
                            ['label' => 'Модификации цены', 'icon' => 'usd', 'url' => ['/course/price-modification/index'], 'active' => $this->context->id == 'course/price-modification'],
                        ],
                    ],
                    [
                        'label' => 'Модерация',
                        'icon' => 'map',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Курсы на модерации', 'icon' => 'reorder', 'url' => ['/course/moderation/index'], 'active' => $this->context->id == 'course/moderation'],
                        ],
                    ],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
