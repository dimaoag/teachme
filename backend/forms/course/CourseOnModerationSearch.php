<?php

namespace backend\forms\course;

use shop\entities\shop\Category;
use shop\helpers\CourseHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\shop\course\Course;
use shop\entities\user\User;
use yii\helpers\ArrayHelper;

class CourseOnModerationSearch extends Model
{
    public $id;
    public $name;
    public $category_id;
    public $created_at;

    public function rules(): array
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['created_at', 'name'], 'safe'],
        ];
    }


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Course::find()->where(['status' => Course::STATUS_ON_MODERATION])->with('mainPhoto', 'category', 'user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 50 ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],

        ]);


        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

//    public function categoriesList(): array
//    {
//        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
//            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
//        });
//    }
//
//    public function statusList(): array
//    {
//        return ProductHelper::statusList();
//    }
}
