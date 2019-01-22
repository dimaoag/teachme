<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $loginForm \shop\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;

?>

<?php foreach ($dataProvider->getModels() as $course): ?>
    <?= $this->render('..//search/_course', [
        'course' => $course
    ]) ?>
<?php endforeach; ?>

<div class="row">
    <div class="col-sm-6 text-left">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
    <div class="col-sm-6 text-right">Найдено <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
</div>
