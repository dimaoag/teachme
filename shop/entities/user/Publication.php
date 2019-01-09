<?php

namespace shop\entities\user;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use shop\entities\shop\CourseType;

/**
 * @property int $course_type_id
 * @property int $user_id
 * @property int $quantity
 *
 * @property CourseType $courseType
 */
class Publication extends ActiveRecord
{
    public static function create($courseTypeId, $quantity): self
    {
        $object = new static();
        $object->course_type_id= $courseTypeId;
        $object->quantity = $quantity;
        return $object;
    }

    public static function blank($courseTypeId): self
    {
        $object = new static();
        $object->course_type_id = $courseTypeId;
        return $object;
    }

    public function addQuantity($quantity): void
    {
        $this->quantity += $quantity;
    }

    public function changeQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function isForCourseType($id): bool
    {
        return $this->course_type_id == $id;
    }

    public function deleteQuantity(): void
    {
        $this->quantity -= 1;
        if ($this->quantity < 0){
            $this->quantity = 0;
        }
    }


    public function getCourseType(): ActiveQuery
    {
        return $this->hasOne(CourseType::class, ['id' => 'course_type_id']);
    }

    public static function tableName(): string
    {
        return '{{%user_publications}}';
    }
}