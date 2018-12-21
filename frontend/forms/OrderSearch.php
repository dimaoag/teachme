<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\shop\course\Order;
use shop\entities\shop\course\Course;
use yii\helpers\ArrayHelper;


class OrderSearch extends Model
{

    public $course_id;
    public $status;
    public $title;
    public $created_at;

    public function rules(): array
    {
        return [
            [['course_id', 'status'], 'integer'],
            [['title'], 'string'],
            [['created_at'], 'safe'],

        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Order::find()->where(['teacher_id' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['status' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }


    public function courseList(): array
    {
        $courses = Course::find()->where(['user_id' => Yii::$app->user->id])->all();
        return ArrayHelper::map($courses, 'id', 'name');
    }
}
