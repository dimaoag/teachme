<?php

use shop\entities\shop\course\Order;
use shop\entities\user\Payment;
use shop\helpers\OrderHelper;
use shop\helpers\PaymentHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use kartik\date\DatePicker;
use backend\widgets\grid\RoleColumn;

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'first_name',
                        'label' => 'Имя',
                        'value' => 'user.first_name',
                    ],
                    [
                        'attribute' => 'last_name',
                        'label' => 'Фамилия',
                        'value' => 'user.last_name',
                    ],
                    [
                        'attribute' => 'phone',
                        'label' => 'Телефон',
                        'value' => 'user.phone',
                    ],
                    [
                        'attribute' => 'course_name',
                        'label' => 'Название курса',
                        'value' => 'course.name',
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
                        'value' => function (Order $order) {
                            return OrderHelper::echoDateTime($order->created_at);
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Order $order) {
                            return OrderHelper::statusLabel($order->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
