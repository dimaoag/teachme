<?php

namespace shop\forms\course\search;

use shop\entities\shop\Characteristic;
use shop\entities\shop\course\Value;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * @property integer $id
 */
class ValueForm extends Model
{

    public $equal;

    private $_characteristic;

    public function __construct(Characteristic $teacherMainInfo, $config = [])
    {
        $this->_characteristic = $teacherMainInfo;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['equal'], 'safe'],

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

    public function variantsListById($id): array
    {
        $characteristic = Characteristic::findOne($id);
        return array_combine($characteristic->variants, $characteristic->variants);
    }

    public function getCharacteristicName(): string
    {
        return $this->_characteristic->name;
    }

    public function isRequired(): bool
    {
        return $this->_characteristic->required ? true : false;
    }

    public function isChecked($id){
        foreach ($this->variantsListById($id) as $value){
            VarDumper::dump($value, 10, true);
//            if (!empty($this->equal)){
//                foreach ($this->equal as $val){
//                    if ($val == $value){
//                        VarDumper::dump($val, 10, true);
//                    }
////
//                }
//            }
        }

//        VarDumper::dump($this->variantsList(), 10, true);
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