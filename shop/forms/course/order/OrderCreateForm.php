<?php

namespace shop\forms\course\order;


use yii\base\Model;


class OrderCreateForm extends Model
{
    public $username;
    public $phone;
    public $course_id;
    public $price;

    public function rules(): array
    {
        return [
            [['username', 'phone', 'course_id', 'price'], 'required'],
            [['phone', 'username'], 'trim'],
            [['username'], 'string', 'max' => 255],
            ['phone', 'replacePhone'],
            ['phone', 'string'],
            ['course_id', 'integer'],
            ['price', 'double'],
        ];
    }


    public function replacePhone()
    {
        $this->phone = str_replace(" ", "", $this->phone);
    }

}