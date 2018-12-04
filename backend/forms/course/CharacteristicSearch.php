<?php

namespace backend\forms\course;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\shop\Characteristic;

class CharacteristicSearch extends Model
{
    public $id;
    public $name;
    public $sort;
    public $required;

    public function rules(): array
    {
        return [
            [['id', 'sort', 'required'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Characteristic::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['sort' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
            'required' => $this->required,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }


    public function requiredList(): array
    {
        return [
            1 => \Yii::$app->formatter->asBoolean(true),
            0 => \Yii::$app->formatter->asBoolean(false),
        ];
    }
}