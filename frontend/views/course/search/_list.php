<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>


<div class="search-courses-nav">
    <div class="count-number-courses">
        Найдено <?= $dataProvider->getCount() ?> обьявлений
    </div>
    <?= Html::a('<span class="button-clear-icon">&Cross;</span><span class="button-clear-text">очистить фильтр</span>', [''], ['class' => 'button-clear']) ?>
    <div class="courses-sort-select">
        <select class="nice-select right sort-select" onchange="location = this.value;">
            <?php
                $values = [
                    '' => 'По умолчанию',
                    'price' => 'от дешевих к дорогим',
                    '-price' => 'от дорогих к дешевым',
                    'rating' => 'по рейтингу',
                ];
            $current = Yii::$app->request->get('sort');
            ?>
            <?php foreach ($values as $value => $label): ?>
                <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <div class="clearfix"></div>
    </div>
</div>
<div class="search-courses-container-wrapper">
    <?php if (!empty($dataProvider->getModels())): ?>
        <?php foreach ($dataProvider->getModels() as $course): ?>
            <?= $this->render('_course', [
                'course' => $course
            ]); ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Ничего не найдено</p>
    <?php endif; ?>

</div>

<div class="row">
    <div class="col-sm-6 text-left">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
</div>