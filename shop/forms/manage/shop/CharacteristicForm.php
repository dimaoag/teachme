<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\Characteristic;
use yii\base\Model;

/**
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $required;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $teacherMainInfo = null, $config = [])
    {
        if ($teacherMainInfo) {
            $this->name = $teacherMainInfo->name;
            $this->required = $teacherMainInfo->required;
            $this->textVariants = implode(PHP_EOL, $teacherMainInfo->variants);
            $this->sort = $teacherMainInfo->sort;
            $this->_characteristic = $teacherMainInfo;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'required' => 'Обязательное',
            'textVariants' => 'Варианты',
            'sort' => 'Сортировка',
        ];
    }


    public function getVariants(): array
    {
        return preg_split('#\n+#i', $this->textVariants);
    }
}