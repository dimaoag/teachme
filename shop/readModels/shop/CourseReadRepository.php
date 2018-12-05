<?php

namespace shop\readModels\shop;

//use Elasticsearch\Client;
use shop\entities\shop\City;
use shop\entities\shop\Category;
use shop\entities\shop\course\Course;
//use shop\forms\shop\search\SearchForm;
//use shop\forms\shop\search\ValueForm;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class CourseReadRepository
{

    public function count(): int
    {
        return Course::find()->active()->count();
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return Course::find()->alias('c')->active('c')->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    /**
     * @return iterable|Course[]
     */
    public function getAllIterator(): iterable
    {
        return Course::find()->alias('c')->active('c')->with('mainPhoto', 'city')->each();
    }

    public function getAll(): DataProviderInterface
    {
        $query = Course::find()->with('mainPhoto');
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Course::find()->alias('c')->active('c')->with('mainPhoto', 'category');
        $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
        $query->joinWith(['categoryAssignments ca'], false);
        $query->andWhere(['or', ['c.category_id' => $ids], ['ca.category_id' => $ids]]);
        $query->groupBy('c.id');
        return $this->getProvider($query);
    }

    public function getAllByBrand(City $city): DataProviderInterface
    {
        $query = Course::find()->alias('c')->active('c')->with('mainPhoto');
        $query->andWhere(['c.city_id' => $city->id]);
        return $this->getProvider($query);
    }
    

    public function getFeatured($limit): array
    {
        return Course::find()->with('mainPhoto')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function find($id)
    {
        return Course::find()->active()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['c.id' => SORT_ASC],
                        'desc' => ['c.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['c.name' => SORT_ASC],
                        'desc' => ['c.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['c.price' => SORT_ASC],
                        'desc' => ['c.price' => SORT_DESC],
                    ],
                ],
            ],
        ]);
    }
    
}