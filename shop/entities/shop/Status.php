<?php

namespace shop\entities\shop;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 */
class Status extends ActiveRecord
{

    public static function create($name): self
    {
        $city = new static();
        $city->name = $name;
        return $city;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    public static function tableName(): string
    {
        return '{{%course_statuses}}';
    }


}