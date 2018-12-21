<?php

namespace shop\forms\course\order;


use yii\base\Model;
use shop\entities\shop\course\Order;


class OrderEditForm extends Model
{

    public $status;
    public $title;
    public $course_id;
    public $order_id;

    private $_order;

    public function __construct(Order $order = null, $config = [])
    {
        if ($order) {
            $this->status = $order->status;
            $this->title = $order->title;
            $this->_order = $order;
        }
        parent::__construct($config);
    }



    public function rules(): array
    {
        return [
            [['status', 'title','course_id', 'order_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['status', 'course_id', 'order_id'], 'integer'],
        ];
    }



    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'status' => 'Статус',
        ];
    }


}