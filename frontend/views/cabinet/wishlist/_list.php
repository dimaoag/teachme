<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="row">
    <div class="col-xs-12 wishlist-wrap">
        <?php foreach ($dataProvider->getModels() as $course): ?>
            <?= $this->render('_course', [
                'course' => $course
            ]) ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 text-left">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
</div>