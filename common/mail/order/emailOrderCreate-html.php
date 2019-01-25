<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$linkOnSite = Yii::$app->urlManager->createAbsoluteUrl(['/course/course/view', 'id' => $data['course_id']]);
?>
<div class="order-email">
    <p><b>Имя:</b> <?= Html::encode($data['username']); ?></p>
    <p><b>Телефон:</b> <?= Html::encode($data['phone']); ?></p>
    <p><b>Курс:</b> <?= Html::encode($data['course_name']); ?></p>
    <p><b>Ссылка на сайт:</b> <?= Html::a(Html::encode($linkOnSite), $linkOnSite) ?></p>
</div>
