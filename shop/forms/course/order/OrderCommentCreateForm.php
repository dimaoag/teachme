<?php

namespace shop\forms\course\order;


use yii\base\Model;


class OrderCommentCreateForm extends Model
{
    public $order_id;
    public $text;

    public function rules(): array
    {
        return [
            [['order_id', 'text'], 'required'],
            [['text'], 'string'],
            [['order_id'], 'integer'],
        ];
    }


}