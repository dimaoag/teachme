<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\City;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;


/**
 * @property MetaForm $meta;
 */
class CityForm extends CompositeForm
{
    public $name;
    public $slug;

    private $_city;

    public function __construct(City $priceModification = null, $config = [])
    {
        if ($priceModification) {
            $this->name = $priceModification->name;
            $this->slug = $priceModification->slug;
            $this->meta = new MetaForm($priceModification->meta);
            $this->_city = $priceModification;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => City::class, 'filter' => $this->_city ? ['<>', 'id', $this->_city->id] : null]
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'slug' => 'Алиас',
        ];
    }


    public function internalForms(): array
    {
        return ['meta'];
    }

}