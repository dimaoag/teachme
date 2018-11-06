<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use shop\helpers\UserHelper;
use shop\entities\user\User;

/* @var $this yii\web\View */
/* @var $model shop\entities\user\User */

$this->title = $model->first_name .' '. $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">


    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
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
                    'email:email',
                    [
                        'attribute' => 'Статус',
                        'filter' => UserHelper::statusList(),
                        'value' => function (User $user) {
                            return UserHelper::statusLabel($user->status);
                        },
                        'format' => 'raw', //отключить фильтрацию через html encode
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'label' => 'Дата создания',
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'datetime',
                        'label' => 'Дата изменения',
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
