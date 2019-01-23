<?php

namespace backend\forms;

use shop\helpers\OrderHelper;
use shop\helpers\PaymentHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\user\Payment;
use shop\entities\shop\course\Order;


class OrderSearch extends Model
{
    public $id;
    public $status;
    public $course_name;
    public $first_name;
    public $last_name;
    public $phone;
    public $date_from;
    public $date_to;


    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['first_name', 'last_name', 'phone', 'course_name'], 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }


    public function search($params)
    {
        $query = Order::find()->alias('o')->joinWith(['user', 'course']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'o.id' => $this->id,
            'o.status' => $this->status,
        ]);


        $query->andFilterWhere(['like', 'user.first_name', $this->first_name])
            ->andFilterWhere(['like', 'user.last_name', $this->last_name])
            ->andFilterWhere(['like', 'user.phone', $this->phone])
            ->andFilterWhere(['like', 'name', $this->course_name])
            ->andFilterWhere(['>=', 'o.created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'o.created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);
        return $dataProvider;
    }


    public function statusList(): array
    {
        return OrderHelper::statusList();
    }

}
