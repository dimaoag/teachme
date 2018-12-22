<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="row">
    <div class="col-md-4 col-xs-6">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-sort">Sort By:</label>
            <select id="input-sort" class="form-control" onchange="location = this.value;">
                <?php
                $values = [
                    '' => 'Default',
                    'name' => 'Name (A - Z)',
                    '-name' => 'Name (Z - A)',
                    'price' => 'Price (Low &gt; High)',
                    '-price' => 'Price (High &gt; Low)'
                ];
                $current = Yii::$app->request->get('sort');
                ?>
                <?php foreach ($values as $value => $label): ?>
                    <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-limit">Show:</label>
            <select id="input-limit" class="form-control" onchange="location = this.value;">
                <?php
                $values = [15, 25, 50, 75, 100];
                $current = $dataProvider->getPagination()->getPageSize();
                ?>
                <?php foreach ($values as $value): ?>
                    <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($dataProvider->getModels() as $course): ?>
        <?= $this->render('..//search/_course', [
            'course' => $course
        ]) ?>
    <?php endforeach; ?>
</div>

<div class="row">
    <div class="col-sm-6 text-left">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
    <div class="col-sm-6 text-right">Найдено <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
</div>