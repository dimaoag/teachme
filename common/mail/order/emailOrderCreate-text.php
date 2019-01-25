<?php
/* @var $this yii\web\View */


$linkOnSite = Yii::$app->urlManager->createAbsoluteUrl(['/course/course/view', 'id' => $data['course_id']]);
?>

Имя: <?= $data['username']; ?>,
Телефон: <?= $data['phone']; ?>,
Курс: <?= $data['course_name']; ?>,
Ссылка на сайт: <?= $linkOnSite ?>,

