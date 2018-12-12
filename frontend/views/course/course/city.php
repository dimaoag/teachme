<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $city \shop\entities\shop\City */
/* @var $searchForm \shop\forms\course\search\SearchForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $city->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $city->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $city->meta->keywords]);

$this->params['breadcrumbs'][] = $city->name;

$this->params['active_category'] = $city;  //put category in View
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
