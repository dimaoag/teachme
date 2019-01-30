<?php

namespace shop\entities\shop\course;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $title
 */
class PriceModification extends ActiveRecord
{
    const FROM          = 1;
    const TO            = 2;
    const IN_MONTH      = 3;
    const FREE          = 4;
    const KNOW_PRICE    = 5;


    public static function create($title): self
    {
        $priceModification = new static();
        $priceModification->title = $title;
        return $priceModification;
    }

    public function edit($title): void
    {
        $this->title = $title;
    }

    public static function tableName(): string
    {
        return '{{%course_price_modifications}}';
    }

}