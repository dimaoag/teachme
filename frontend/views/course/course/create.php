<?php

use Yii;
use yii\helpers\Url;

?>
<main>
    <div class="container add-course">
        <div class="row">
            <form method="post" action="<?= Url::to(['/course/course/create']); ?>" id="add_course_form" enctype="multipart/form-data">
                <ul class="nav nav-tabs">
                    <li class="nav-item active_tab1" id="list_main_info">
                        Краткая информация
                    </li>
                    <li class="nav-item inactive_tab1" id="list_description_info">
                        Описания и галерея
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active step-1" id="main_info">
                        <div class="panel panel-default form-horizontal">
                            <div class="upload-image">
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <h4>Выберите изображения курса</h4>
                                        <div class="row">
                                            <div id="photo_course"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <span id="error_photo" class="text-danger"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name">Названия курса</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" id="name" class="form-control" required/>
                                        <span id="error_name" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="city">Город</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select main-select-city">
                                                <select class="form-control" name="city" id="city" required>
                                                    <option value="0">Выберите город</option>
                                                    <option value="1">Киев</option>
                                                    <option value="2">Винница</option>
                                                    <option value="3">Одесса</option>
                                                </select>
                                            </div>
                                        </div>
                                        <span id="error_city" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="category">Рубрика</label>
                                    <div class="col-sm-4 header-search-city">
                                        <div class="add-course-select">
                                            <div class="custom-select main-select-city">
                                                <select class="form-control" name="category" id="category" required>
                                                    <option value="0">Выберите рубрику</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <span id="error_category" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="price">Цена</label>
                                    <div class="col-sm-3">
                                        <div class="add-course-price-field">
                                            <input name="price" id="price" pattern="^[0-9.]{1,}$" class="form-control" required/>
                                            <p class="form-currency">грн.</p>
                                        </div>
                                        <span id="error_price" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group bottom-block">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="type_education">Тип обучения</label>
                                            <div class="col-sm-7 header-search-city">
                                                <div class="add-course-select">
                                                    <div class="custom-select main-select-city">
                                                        <select class="form-control" name="type_education" id="type_education" required>
                                                            <option value="0">Тип обучения</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="error_type_education" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="form_education">Форма обучения</label>
                                            <div class="col-sm-7 header-search-city">
                                                <div class="add-course-select">
                                                    <div class="custom-select main-select-city">
                                                        <select class="form-control" name="form_education" id="form_education" required>
                                                            <option value="0">Форма обучения</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="error_form_education" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="quantity_group">Группа</label>
                                            <div class="col-sm-7 header-search-city">
                                                <div class="add-course-select">
                                                    <div class="custom-select main-select-city">
                                                        <select class="form-control" name="quantity_group" id="quantity_group" required>
                                                            <option value="0">Група</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="error_quantity_group" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="level">Уровень подготовки</label>
                                            <div class="col-sm-7 header-search-city">
                                                <div class="add-course-select">
                                                    <div class="custom-select main-select-city">
                                                        <select class="form-control" name="level" id="level" required>
                                                            <option value="0">Уровень подготовки</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="error_level" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="result">По окончанию выдаеться</label>
                                            <div class="col-sm-7 header-search-city">
                                                <div class="add-course-select">
                                                    <div class="custom-select main-select-city">
                                                        <select class="form-control" name="result" id="result" required>
                                                            <option value="0">Выберите документ</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="error_result" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-7">
                                    <div align="center">
                                        <button type="button" name="btn_main_info" id="btn_main_info" class="btn btn-block btn-lg button-pure">Далее</button>
                                    </div>
                                </div>

                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade step-2" id="description_info">
                        <div class="panel panel-default form-horizontal">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <h2 class="step-2-title-description">Описание курса</h2>
                                        <textarea name="description" rows="15" id="description" class="form-control"></textarea>
                                        <span id="error_description" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="upload-image">
                                    <h2>Фотогалерея курса</h2>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div id="gallery"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-2-buttons">
                                    <div class="col-xs-6">
                                        <div align="center">
                                            <button type="button" name="previous_btn_description" id="previous_btn_description" class="btn btn-block btn-default btn-lg">Назад</button>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div align="center">
                                            <button type="submit" name="btn_description" id="btn_description" class="btn btn-block button-pure btn-lg">Сохранить</button>
                                        </div>
                                    </div>
                                </div>

                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact_details">
                        <div class="panel panel-default">
                            <div class="panel-heading">Fill Contact Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Enter Address</label>
                                    <textarea name="address" id="address" class="form-control"></textarea>
                                    <span id="error_address" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Enter Mobile No.</label>
                                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" />
                                    <span id="error_mobile_no" class="text-danger"></span>
                                </div>
                                <br />
                                <div align="center">
                                    <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>