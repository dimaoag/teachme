<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = 'Избраные курсы';
$this->params['breadcrumbs'][] = $this->title;

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