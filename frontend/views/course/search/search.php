<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $course \shop\entities\shop\course\Course */
/* @var $category \shop\entities\shop\Category*/
/* @var $searchForm \shop\forms\course\search\SearchForm */
/* @var $loginForm \shop\forms\auth\LoginForm */

use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Поиск курсов';


if ($searchForm->category){
    $category = $searchForm->getCategoryById($searchForm->category);
    foreach ($category->parents as $parent) {
        if (!$parent->isRoot()) {
            $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['/course/search/search', 'category' => $parent->id]];
        }
    }
    $this->params['breadcrumbs'][] = $category->name;
} else {
    $this->params['breadcrumbs'][] = 'Поиск курсов';
}

?>


<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <input type="hidden" class="max-price" id="max_price_of_courses" name="max-price" value="<?= $maxPrice; ?>">
            <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get',  'enableClientValidation' => false]) ?>

            <?php if ($searchForm->category): ?>
                <?= $form->field($searchForm, 'category')->hiddenInput()->label(false) ?>
            <?php endif; ?>


                <div class="filter-wrap">
                    <div class="city-select-wrap">
<!--                        --><?php //= $form->field($searchForm, 'city')->dropDownList($searchForm->citiesList(), ['prompt' => 'Выберите город', 'class' => 'city-select'])->label(false) ?>
                        <?= $form->field($searchForm, 'city')->widget(Select2::class, [
                            'data' => $searchForm->citiesList(),
                            'options' => [
                                'placeholder' => 'Выберите город...',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'containerCssClass' => 'my_sec'
                            ],
                            'pluginEvents' => [
//                                "change" => "function() { log('change'); }",
                                "select2:opening" => "function() { console.log('opening'); $('.select2-dropdown .select2-dropdown--below').addClass(' my');  console.log($('.select2-dropdown .select2-dropdown--below'));}",
//                                "select2:open" => "function() { log('open'); }",
                                "select2:closing" => "function() { console.log('close'); }",
//                                "select2:close" => "function() { log('close'); }",
//                                "select2:selecting" => "function() { log('selecting'); }",
//                                "select2:select" => "function() { log('select'); }",
//                                "select2:unselecting" => "function() { log('unselecting'); }",
//                                "select2:unselect" => "function() { log('unselect'); }"
                            ],
                        ])->label(false); ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="filter">
                        <a href="#filter_course_type" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                            <h4>Тип обучения</h4>
                            <i class="toggle plus" style="display: none;">&#xFF0B;
                            </i>
                            <i class="toggle minus">&#xFF0D;
                            </i>
                        </a>
                        <ul class="collapse list-unstyled collapse in" id="filter_course_type">
                            <?php $c = 0; ?>
                            <?php foreach ($searchForm->courseTypesList() as $courseTypeKey => $courseTypeValue): ?>
                                <li>
                                    <div class="checkboxes">
                                        <div class="cntr">
                                            <label for="cbx_course_type_<?=$c?>" class="label-cbx">
                                                <input id="cbx_course_type_<?=$c?>" name="courseType[]" type="checkbox"  value="<?= Html::encode($courseTypeKey); ?>" <?php if (!empty($searchForm->courseType)){
                                                    foreach ($searchForm->courseType as $key => $value){
                                                        if (rtrim($value) == rtrim($courseTypeKey)){
                                                            echo ' checked';
                                                        }
                                                    }
                                                } ?>  class="invisible">
                                                <div class="checkbox">
                                                    <svg width="13px" height="13px" viewBox="0 0 20 20">
                                                        <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                        <polyline points="4 11 8 15 16 6"></polyline>
                                                    </svg>
                                                </div>
                                                <span><?= Html::encode($courseTypeValue); ?></span>
<!--                                                <span class="count-number">(402)</span>-->
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <?php $c++; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php $k = 0; ?>
                    <?php foreach ($searchForm->values as $i => $value): ?>
                        <?php if ($value->isRequired()): ?>
                            <div class="filter">
                                <a href="#filter<?=$i?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle filter-header">
                                    <h4><?= Html::encode($value->getCharacteristicName())?></h4>
                                    <i class="toggle plus" style="display: none;">&#xFF0B;
                                    </i>
                                    <i class="toggle minus">&#xFF0D;
                                    </i>
                                </a>
                                <ul class="collapse list-unstyled collapse in" id="filter<?=$i?>">
                                    <?php if ($variants = $value->variantsList()): ?>


                                        <?php $j = 0;?>
                                        <?php foreach ($variants as $key => $variant): ?>

                                            <li>
                                                <div class="checkboxes">
                                                    <div class="cntr">
                                                        <label for="cbx<?=$k?>" class="label-cbx">
                                                            <input id="cbx<?=$k?>" name="v[<?=$i?>][equal][]" <?php if (isset($searchForm->values[$i]['equal'])){
                                                                foreach ($searchForm->values[$i]['equal'] as $id => $val){
                                                                    if (rtrim($val) == rtrim($variant)){
                                                                        echo ' checked';
                                                                    }
                                                                }
                                                            } ?> type="checkbox"  value="<?= Html::encode($variant); ?>" class="invisible">
                                                            <div class="checkbox">
                                                                <svg width="13px" height="13px" viewBox="0 0 20 20">
                                                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                                    <polyline points="4 11 8 15 16 6"></polyline>
                                                                </svg>
                                                            </div>
                                                            <span><?= Html::encode($variant); ?></span>
<!--                                                            <span class="count-number">(402)</span>-->
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
                            <div class="range-inputs">
                                <input type="number" name="from" value="<?= $searchForm->from ?: null ?>"  id="min_price">
                                <p> - </p>
                                <input type="number" name="to" value="<?= $searchForm->to ?: null ?>" id="max_price">
                            </div>
                            <div class="price_my_range" id="price_my_range"></div>
                        </div>
                    </div>
                    <div class="search-submit">
                        <button type="submit" class="button search-btn">Найти</button>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-9 col-sm-8 search-courses-container">
            <?= $this->render('_list', [
                'dataProvider' => $dataProvider,
                'loginForm' => $loginForm
            ]) ?>
        </div>
    </div>
    <div class="row buttons-sm">
        <div class="col-xs-12">
            <button class="open-popup button-sm" href="#search-filter-sm">Фильтр</button>
            <button class="open-popup button-sm" href="#sort-sm">Сортировка</button>
        </div>
    </div>
</div>
<div id="search-filter-sm" class="white-popup mfp-hide search-filter-sm">
    <div class="header-filter-sm">
        <button class="header-filter-back-btn">
        </button>
        <p>Фильтр</p>
    </div>

    <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get', 'id' => 'sm_filter',  'enableClientValidation' => false]) ?>

        <div class="filter-wrap filter-wrap-sm">
            <div class="city-select-wrap">
                <?= $form->field($searchForm, 'city')->dropDownList($searchForm->citiesList(), ['prompt' => 'Выберите город', 'id' => 'city_sm', 'class' => 'city-select'])->label(false) ?>
                <div class="clearfix"></div>
            </div>

            <div class="filter">
                <div class="filter-header-sm">
                    <h4>Тип обучения</h4>
                </div>
                <ul class="collapse list-unstyled collapse in">
                    <?php $c_sm = 0; ?>
                    <?php foreach ($searchForm->courseTypesList() as $courseTypeKey => $courseTypeValue): ?>
                        <li>
                            <div class="checkboxes">
                                <div class="cntr">
                                    <label for="cbx_course_type_sm_<?=$c_sm?>" class="label-cbx">
                                        <input id="cbx_course_type_sm_<?=$c_sm?>" name="courseType[]" type="checkbox"  value="<?= Html::encode($courseTypeKey); ?>" <?php if (!empty($searchForm->courseType)){
                                            foreach ($searchForm->courseType as $key => $value){
                                                if (rtrim($value) == rtrim($courseTypeKey)){
                                                    echo ' checked';
                                                }
                                            }
                                        } ?>  class="invisible">
                                        <div class="checkbox">
                                            <svg width="13px" height="13px" viewBox="0 0 20 20">
                                                <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                <polyline points="4 11 8 15 16 6"></polyline>
                                            </svg>
                                        </div>
                                        <span><?= Html::encode($courseTypeValue); ?></span>
<!--                                        <span class="count-number">(402)</span>-->
                                    </label>
                                </div>
                            </div>
                        </li>
                        <?php $c_sm++; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php $k_sm = 0; ?>
            <?php foreach ($searchForm->values as $i_sm => $value): ?>
                <?php if ($value->isRequired()): ?>
                    <div class="filter">

                        <h4><?= Html::encode($value->getCharacteristicName())?></h4>

                        <ul class="collapse list-unstyled collapse in">
                            <?php if ($variants = $value->variantsList()): ?>
                                <?php foreach ($variants as $key => $variant): ?>
                                    <li>
                                        <div class="checkboxes">
                                            <div class="cntr">
                                                <label for="cbx_sm<?=$k_sm?>" class="label-cbx">
                                                    <input id="cbx_sm<?=$k_sm?>" name="v[<?=$i_sm?>][equal][]" <?php if (isset($searchForm->values[$i_sm]['equal'])){
                                                        foreach ($searchForm->values[$i_sm]['equal'] as $id => $val){
                                                            if (rtrim($val) == rtrim($variant)){
                                                                echo ' checked';
                                                            }
                                                        }
                                                    } ?> type="checkbox"  value="<?= Html::encode($variant); ?>" class="invisible">
                                                    <div class="checkbox">
                                                        <svg width="13px" height="13px" viewBox="0 0 20 20">
                                                            <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                            <polyline points="4 11 8 15 16 6"></polyline>
                                                        </svg>
                                                    </div>
                                                    <span><?= Html::encode($variant); ?></span>
<!--                                                    <span class="count-number">(402)</span>-->
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <?php $k_sm++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php $i_sm++; ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="filter">
                <h4>Цена</h4>
                <div class="checkboxes">
                    <div class="range-inputs">
                        <input type="number" name="from" value="<?= $searchForm->from ?: null ?>" id="min_price_sm">
                        <p> - </p>
                        <input type="number" name="to" value="<?= $searchForm->to ?: null ?>" id="max_price_sm">
                    </div>
                    <div class="price_my_range" id="price_my_range_sm"></div>
                </div>
            </div>
        </div>
        <div class="search-filter-sm-buttons">
            <button class="button-sm" type="submit">Применить</button>
            <?= Html::a('Очистить', [''], ['class' => 'button-sm bg-clear']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>



<div id="sort-sm" class="white-popup mfp-hide sort-sm">
    <div class="sort-sm-wrap">
        <a href="<?= Url::current(['sort' => 'rating']);?>" class="sort-sm-item">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="15" viewBox="0 0 16 15"><defs><path id="53jia" d="M202.795 695l2.409 4.88 5.386.783-3.898 3.8.92 5.364-4.817-2.533-4.818 2.533.92-5.365-3.897-3.799 5.386-.782z"/></defs><g><g transform="translate(-195 -695)"><use fill="#efce4a" xlink:href="#53jia"/></g></g></svg>
            </span>
            <span class="text">За рейтингом</span>
        </a>
        <a href="<?= Url::current(['sort' => '-price']);?>" class="sort-sm-item">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="15" viewBox="0 0 16 15"><defs><path id="v2gra" d="M197.605 725.24l-2.007 3.472a.298.298 0 1 0 .517.298l1.45-2.51v12.807a.298.298 0 0 0 .598 0v-12.805l1.45 2.508a.299.299 0 0 0 .517-.298l-2.008-3.472a.299.299 0 0 0-.517 0z"/><path id="v2grb" d="M208.025 725.24l-2.007 3.472a.298.298 0 1 0 .517.298l1.451-2.51v12.808a.298.298 0 0 0 .597 0v-12.806l1.45 2.508a.299.299 0 0 0 .517-.298l-2.008-3.472a.299.299 0 0 0-.517 0z"/></defs><g><g transform="translate(-195 -725)"><use fill="#0a0a0a" xlink:href="#v2gra"/></g><g transform="translate(-195 -725)"><use fill="#0a0a0a" xlink:href="#v2grb"/></g></g></svg>
            </span>
            <span class="text">Дорогие</span>
        </a>
        <a href="<?= Url::current(['sort' => 'price']);?>" class="sort-sm-item">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="15" viewBox="0 0 16 15"><defs><path id="tqf6a" d="M197.605 769.457l-2.007-3.473a.298.298 0 1 1 .517-.298l1.45 2.51V755.39a.298.298 0 0 1 .598 0v12.805l1.45-2.508a.299.299 0 0 1 .517.298l-2.008 3.473a.299.299 0 0 1-.517 0z"/><path id="tqf6b" d="M208.025 769.457l-2.007-3.473a.298.298 0 1 1 .517-.298l1.451 2.51V755.39a.298.298 0 0 1 .597 0v12.805l1.45-2.508a.299.299 0 0 1 .517.298l-2.008 3.473a.299.299 0 0 1-.517 0z"/></defs><g><g transform="translate(-195 -755)"><use fill="#0a0a0a" xlink:href="#tqf6a"/></g><g transform="translate(-195 -755)"><use fill="#0a0a0a" xlink:href="#tqf6b"/></g></g></svg>
            </span>
            <span class="text">Дешевые</span>
        </a>
    </div>

</div>

