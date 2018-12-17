<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\Characteristic;
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
            [['cityId', 'firmId', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['cityId', 'firmId', 'price'], 'integer'],
            ['description', 'string'],
            ['price', 'integer', 'min' => 0],
        ];
    }

    public function citiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
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