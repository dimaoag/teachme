<?php

use shop\entities\user\Payment;
use shop\helpers\PaymentHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use kartik\date\DatePicker;
use backend\widgets\grid\RoleColumn;

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Платежи';
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
                        'attribute' => 'price',
                        'label' => 'Цена',
                    ],
                    [
                        'attribute' => 'quantity',
                        'label' => 'Количество',
                    ],
                    [
                        'attribute' => 'sum',
                        'label' => 'Сума',
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Дата',
                        'value' => function (Payment $payment) {
                            return PaymentHelper::echoDate($payment->created_at);
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Payment $payment) {
                            return PaymentHelper::statusLabel($payment->status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn','header'=>"Действия",
                        'template' => '{delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
