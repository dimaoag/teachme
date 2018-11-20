<?php

use yii\helpers\Html;
use yii\grid\GridView;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'first_name',
                        'label' => 'Имя',
                    ],
                    [
                        'attribute' => 'last_name',
                        'label' => 'Фамилия',
                    ],
                    [
                        'attribute' => 'phone',
                        'label' => 'Телефон',
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Дата создания',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'language' => 'ru',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'language' => 'ru',
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'value' => function (User $user) {
                            return UserHelper::echoDate($user->created_at);
                        },
                    ],
                    'email:email',
                    [
                            'attribute' => 'designation',
                            'label' => 'Обозначения',
                            'filter' => UserHelper::designationList(),
                            'value' => function (User $user) {
                                return UserHelper::designationValue($user->designation);
                            },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'filter' => UserHelper::statusList(),
                        'value' => function (User $user) {
                            return UserHelper::statusLabel($user->status);
                        },
                        'format' => 'raw', //отключить фильтрацию через html encode
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
