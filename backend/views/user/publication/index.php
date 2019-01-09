<?php

use yii\helpers\Html;
use yii\grid\GridView;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use kartik\date\DatePicker;
use backend\widgets\grid\RoleColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
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
                        'label' => 'Публикации',
                        'value' => function (User $user) {
                            return UserHelper::getPublications($user);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
