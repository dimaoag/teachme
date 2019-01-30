<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\PriceModification;
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
    public $priceModificationId;
    public $name;
    public $description;
    public $price;
    public $old_price;

    private $_course;

    public function __construct(Course $course, $config = [])
    {
        $this->photos = new PhotosForm();
        $this->gallery = new GalleryForm();
        $this->cityId = $course->city_id;
        $this->priceModificationId = $course->price_modification_id ?: $this->priceModificationDefaultValue();
        $this->name = $course->name;
        $this->description = preg_replace("/<([a-z]*)\b[^>]*>/","\r\n", $course->description);
        $this->price = $course->price;
        $this->old_price = $course->old_price;
        $this->categories = new CategoriesForm($course);
        $this->_course = $course;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['cityId', 'priceModificationId','name'], 'required'],
            [['cityId', 'price', 'old_price', 'priceModificationId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['description', 'string'],
            [['price', 'old_price'], 'match', 'pattern' => '/^[0-9]{1,}$/'],
            [['description'], 'filter', 'filter' => function($value){
                return trim(preg_replace("/\r\n|\r/", "<br>", $value));
            }],
            [['price'], 'filter', 'filter' => function($value){
                return $value ?: 0 ;
            }],
        ];
    }

    public function citiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function priceModificationList(): array
    {
        return ArrayHelper::map(PriceModification::find()->asArray()->all(), 'id', 'title');
    }


    public function priceModificationDefaultValue(): int
    {
        $value[0] = ArrayHelper::map(PriceModification::find()->asArray()->all(), 'id', 'title');
        $res = key( $value[0]);
        return $res;
    }

    protected function internalForms(): array
    {
        return ['categories', 'photos', 'gallery'];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'cityId' => 'Город',
            'priceModificationId' => 'Модификация цены',
            'price' => 'Цена',
            'old_price' => 'Старая цена',
            'description' => 'Описание',
        ];
    }
}