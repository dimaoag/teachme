<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\course\PriceModification;
use yii\base\Model;


class PriceModificationForm extends Model
{
    public $title;

    private $_priceModification;
    public function __construct(PriceModification $priceModification = null, $config = [])
    {
        if ($priceModification) {
            $this->title = $priceModification->title;
            $this->_priceModification = $priceModification;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => 'Название',
        ];
    }

}