<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\course\Error;
use yii\base\Model;


class ErrorForm extends Model
{
    public $message;

    private $_error;

    public function __construct(Error $error = null, $config = [])
    {
        if ($error) {
            $this->message = $error->message;
            $this->_error = $error;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['message'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'message' => 'Текст ошибки',
        ];
    }

}