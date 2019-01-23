<?php
namespace shop\forms\manage\user;


use yii\base\Model;

class PaymentForm extends Model
{
    public $courseTypeId;
    public $price;
    public $quantity;
    public $sum;


    public function rules()
    {
        return [
            [['courseTypeId', 'price', 'quantity', 'sum'], 'required'],
            [['courseTypeId', 'price', 'quantity', 'sum'], 'integer'],
        ];
    }

    public function quantityList(){
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
        ];
    }


}