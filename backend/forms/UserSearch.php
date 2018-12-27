<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\user\User;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form of `shop\entities\user\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $status;
    public $date_from;
    public $date_to;
    public $first_name;
    public $last_name;
    public $phone;
    public $designation;
    public $role;


    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['designation'], 'string'],
            [['first_name', 'last_name', 'phone', 'role'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }


    public function search($params)
    {
        $query = User::find()->alias('u');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'u.id' => $this->id,
            'u.status' => $this->status,
        ]);

        if (!empty($this->role)) {
            $query->innerJoin('{{%auth_assignments}} a', 'a.user_id = u.id');
            $query->andWhere(['a.item_name' => $this->role]);
        }

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
        ];
    }


    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

}
