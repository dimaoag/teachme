<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\CourseType;
use yii\base\Model;

/**
 * @property array $variants
 */
class CourseTypeForm extends Model
{
    public $name;
    public $price;
    public $sort;

    private $_courseType;

    public function __construct(CourseType $courseType = null, $config = [])
    {
        if ($courseType) {
            $this->name = $courseType->name;
            $this->price = $courseType->price;
            $this->sort = $courseType->sort;
            $this->_courseType = $courseType;
        } else {
            $this->sort = CourseType::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'price', 'sort'], 'required'],
            [['name'], 'string'],
            [['sort', 'price'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'price' => 'Цена',
            'sort' => 'Сортировка',
        ];
    }
}