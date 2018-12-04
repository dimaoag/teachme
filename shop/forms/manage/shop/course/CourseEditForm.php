<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\Characteristic;
use shop\entities\shop\course\Course;
use shop\forms\CompositeForm;
use yii\helpers\ArrayHelper;

/**
 * @property CategoriesForm $categories
 */
class CourseEditForm extends CompositeForm
{
    public $cityId;
    public $name;
    public $description;
    public $price;

    private $_course;

    public function __construct(Course $course, $config = [])
    {
        $this->cityId = $course->city_id;
        $this->name = $course->name;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->categories = new CategoriesForm($course);
        $this->_course = $course;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['cityId', 'name', 'price'], 'required'],
            [['cityId', 'price'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['description', 'string'],
            ['price', 'integer', 'min' => 0],
        ];
    }

    public function citiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['categories'];
    }
}