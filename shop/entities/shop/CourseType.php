<?php

namespace shop\entities\shop;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $sort
 * @property integer $created_at
 */
class CourseType extends ActiveRecord
{

    public static function create($name, $price, $sort): self
    {
        $courseType = new static();
        $courseType->name = $name;
        $courseType->price = $price;
        $courseType->sort = $sort;
        $courseType->created_at = time();
        return $courseType;
    }

    public function edit($name, $price, $sort): void
    {
        $this->name = $name;
        $this->price = $price;
        $this->sort = $sort;
    }

    public static function tableName(): string
    {
        return '{{%course_types}}';
    }


}