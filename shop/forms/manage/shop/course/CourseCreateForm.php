<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\City;
use shop\entities\shop\Characteristic;
use shop\entities\shop\course\PriceModification;
use shop\entities\shop\CourseType;
use shop\entities\shop\TeacherMainInfo;

use shop\forms\CompositeForm;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property ValueForm[] $values
 */
class CourseCreateForm extends CompositeForm
{
    public $cityId;
    public $priceModificationId;
    public $courseTypeId;
    public $firmId;
    public $name;
    public $description;
    public $price;
    public $old_price;

    public function __construct($config = [])
    {

        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['cityId', 'firmId', 'courseTypeId', 'priceModificationId','name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['cityId', 'firmId', 'courseTypeId', 'price', 'old_price', 'priceModificationId'], 'integer'],
            [['price', 'old_price'], 'match', 'pattern' => '/^[0-9]{1,}$/'],
            ['description', 'string'],
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
        return ['photos', 'categories', 'values'];
    }

    public function attributeLabels()
    {
        return [
            'cityId' => 'Город',
            'priceModificationId' => 'Модификация цены',
            'firmId' => 'Организация',
            'courseTypeId' => 'Тип курса',
            'name' => 'Название курса',
            'price' => 'Цена',
            'old_price' => 'Старая цена',
            'description' => 'Описание',
        ];
    }
}