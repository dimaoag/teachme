<?php

namespace backend\forms;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\user\User;


/**
 * UserSearch represents the model behind the search form of `shop\entities\user\User`.
 */
class UserTeacherSearch extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $phone;


    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['first_name', 'last_name', 'phone'], 'safe'],
        ];
    }


    public function search($params)
    {
        $query = User::find()->where(['designation' => User::TEACHER])->alias('u');

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
            'u.id' => $this->id,
        ]);

        if (!empty($this->role)) {
            $query->innerJoin('{{%auth_assignments}} a', 'a.user_id = u.id');
            $query->andWhere(['a.item_name' => $this->role]);
        }

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }


}
