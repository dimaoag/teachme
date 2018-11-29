<?php

namespace shop\entities\shop;

use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $required
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{

    public $variants;

    public static function create($name, $required, array $variants, $sort): self
    {
        $object = new static();
        $object->name = $name;
        $object->required = $required;
        $object->variants = $variants;
        $object->sort = $sort;
        return $object;
    }

    public function edit($name, $required, array $variants, $sort): void
    {
        $this->name = $name;
        $this->required = $required;
        $this->variants = $variants;
        $this->sort = $sort;
    }


    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    public static function tableName(): string
    {
        return '{{%course_characteristics}}';
    }

    public function afterFind(): void
    {
        $this->variants = array_filter(Json::decode($this->getAttribute('variants_json')));
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('variants_json', Json::encode(array_filter($this->variants)));
        return parent::beforeSave($insert);
    }
}