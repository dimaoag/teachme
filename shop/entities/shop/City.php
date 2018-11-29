<?php

namespace shop\entities\shop;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class City extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta): self
    {
        $city = new static();
        $city->name = $name;
        $city->slug = $slug;
        $city->meta = $meta;
        return $city;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public static function tableName(): string
    {
        return '{{%course_cities}}';
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    ##########################

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
        ];
    }

}