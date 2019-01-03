<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\Characteristic;
use shop\entities\shop\CourseType;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\shop\course\Course;
use shop\entities\user\User;

use shop\forms\CompositeForm;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property GalleryForm $gallery
 * @property ValueForm[] $values
 */
class CourseCreateForm extends CompositeForm
{
    public $cityId;
    public $courseTypeId;
    public $firmId;
    public $name;
    public $description;
    public $price;

    public function __construct($config = [])
    {

        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->gallery = new GalleryForm();
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['cityId', 'firmId', 'courseTypeId', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['cityId', 'firmId', 'courseTypeId', 'price'], 'integer'],
            ['description', 'string'],
            [['description'], 'filter', 'filter' => function($value){
                return trim(preg_replace("/\r\n|\r/", "<br />", $value));
            }],
            ['price', 'integer', 'min' => 0],
        ];
    }

    public function citiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function courseTypesList(): array
    {
        return ArrayHelper::map(CourseType::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function firmList(): array
    {
        return ArrayHelper::map(TeacherMainInfo::find()->where(['user_id' => Yii::$app->user->id])->orderBy('firm_name')->asArray()->all(), 'id', 'firm_name');
    }

    protected function internalForms(): array
    {
        return ['photos', 'categories', 'values', 'gallery'];
    }
}