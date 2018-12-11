<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var \shop\entities\shop\course\Course $course */
/* @var $searchForm \shop\forms\course\search\SearchForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Поиск курсов';
$this->params['breadcrumbs'][] = 'Поиск курсов';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <input type="hidden" class="max-price" id="max-price" name="max-price" value="<?= $maxPrice; ?>">
                <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get']) ?>

                <div class="filter-wrap">

                    <?php $k = 0; ?>
                    <?php foreach ($searchForm->values as $i => $value): ?>
                        <?php if ($value->isRequired()): ?>
                            <div class="filter">
                                <a href="#filter<?=$i?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                                    <h4><?= Html::encode($value->getCharacteristicName())?></h4>
                                    <i class="toggle fa fa-plus" style="display: none"></i>
                                    <i class="toggle fa fa-minus"></i>
                                </a>
                                <ul class="collapse list-unstyled collapse in" id="filter<?=$i?>">
                                    <?php if ($variants = $value->variantsList()): ?>


                                     <?php $j = 0;?>
                                        <?php foreach ($variants as $key => $variant): ?>

                                            <li>
                                                <div class="checkboxes">
                                                    <div class="cntr">
                                                        <label for="cbx<?=$k?>" class="label-cbx">
                                                            <input id="cbx<?=$k?>" name="v[<?=$i?>][equal][]" <?= isset($searchForm->values[$i]['equal'][$j]) ? ' checked' : '' ?> type="checkbox"  value="<?= Html::encode($variant); ?>" class="invisible">
                                                            <div class="checkbox">
                                                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                                </svg>
                                                            </div>
                                                            <span><?= Html::encode($variant); ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php $j++; ?>
                                            <?php $k++; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php $i++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="filter">
                        <h4>Цена</h4>
                        <div class="checkboxes">
                            <!--<input type="hidden" id="hidden_minimum_price" value="0">-->
                            <!--<input type="hidden" id="hidden_maximum_price" value="10000">-->
                            <!--<p id="price_show">1000 - 10000 грн</p>-->
                            <!--<div id="price_range"></div>-->

                            <!--<p id="amount"></p>-->
                            <!--<div id="slider-range" class="price-range" style="margin: 25px 0;"></div>-->
                            <!--<input type="hidden" id="min_price">-->
                            <!--<input type="hidden" id="max_price">-->
                            <div class="price_my_range" id="price_my_range">
                            </div>
                            <div class="range-inputs">
                                <p>от</p>
                                <input type="number" name="from" value="<?= $searchForm->from ?: null ?>"  id="min_price">
                                <p>до</p>
                                <input type="number" name="to" value="<?= $searchForm->to ?: null ?>" id="max_price">
                                <p>грн.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-success">Найти</button>
                <br>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-md-9 search-courses-container">
                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider
                ]) ?>
            </div>
        </div>
    </div>
</main>
