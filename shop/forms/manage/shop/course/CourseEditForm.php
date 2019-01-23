<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\course\Course;
use shop\forms\CompositeForm;
use yii\helpers\ArrayHelper;

/**
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property GalleryForm $gallery
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
        $this->photos = new PhotosForm();
        $this->gallery = new GalleryForm();
        $this->cityId = $course->city_id;
        $this->name = $course->name;
        $this->description = preg_replace("/<([a-z]*)\b[^>]*>/","\r\n", $course->description);
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
            [['description'], 'filter', 'filter' => function($value){
                return trim(preg_replace("/\r\n|\r/", "<br>", $value));
            }],
            ['price', 'integer', 'min' => 0],
        ];
    }

    public function citiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['categories', 'photos', 'gallery'];
    }
}