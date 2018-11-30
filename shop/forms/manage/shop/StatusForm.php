<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\Status;
use yii\base\Model;


class StatusForm extends Model
{
    public $name;

    private $_status;

    public function __construct(Status $status = null, $config = [])
    {
        if ($status) {
            $this->name = $status->name;
            $this->_status = $status;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetClass' => Status::class, 'filter' => $this->_status ? ['<>', 'id', $this->_status->id] : null]
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Название',
        ];
    }

}