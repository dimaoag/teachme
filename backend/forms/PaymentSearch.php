<?php

namespace backend\forms;

use shop\helpers\PaymentHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\user\Payment;
/**
 * UserSearch represents the model behind the search form of `shop\entities\user\User`.
 */
class PaymentSearch extends Model
{
    public $id;
    public $status;
    public $first_name;
    public $last_name;
    public $phone;


    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['first_name', 'last_name', 'phone'], 'string'],
        ];
    }


    public function search($params)
    {
        $query = Payment::find()->alias('p')->joinWith('user');


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
            'p.id' => $this->id,
            'p.status' => $this->status,
        ]);



        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
        ];
    }


    public function statusList(): array
    {
        return PaymentHelper::statusList();
    }

}
