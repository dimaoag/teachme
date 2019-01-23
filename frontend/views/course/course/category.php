<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category \shop\entities\shop\Category */
/* @var $searchForm \shop\forms\course\search\SearchForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;

$this->params['active_category'] = $category;  //put category in View
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-9 search-courses-container">
                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider
                ]) ?>
            </div>
        </div>
    </div>
</main>
