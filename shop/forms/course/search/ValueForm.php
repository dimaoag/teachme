<?php

namespace shop\forms\course\search;

use shop\entities\shop\Characteristic;
use shop\entities\shop\course\Value;
use yii\base\Model;

/**
 * @property integer $id
 */
class ValueForm extends Model
{

    public $equal;

    private $_characteristic;

    public function __construct(Characteristic $characteristic, $config = [])
    {
        $this->_characteristic = $characteristic;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['equal'], 'string'],

        ];
    }

    public function isFilled(): bool
    {
        return !empty($this->equal);
    }

    public function variantsList(): array
    {
        return $this->_characteristic->variants ? array_combine($this->_characteristic->variants, $this->_characteristic->variants) : [];
    }

    public function getCharacteristicName(): string
    {
        return $this->_characteristic->name;
    }

    public function getId(): int
    {
        return $this->_characteristic->id;
    }

    public function formName(): string
    {
        return 'v';
    }
}