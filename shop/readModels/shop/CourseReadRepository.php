<?php

namespace shop\readModels\shop;

use Elasticsearch\Client;
use phpDocumentor\Reflection\Types\Integer;
use shop\entities\shop\TeacherMainInfo;
use shop\entities\shop\City;
use shop\entities\shop\Category;
use shop\entities\shop\course\Course;
use shop\forms\course\search\SearchForm;
use shop\forms\course\search\ValueForm;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class CourseReadRepository
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


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
        $query->andWhere(['or', ['c.category_id' => $ids]]);
        $query->groupBy('c.id');
        return $this->getProvider($query);
    }

    public function getAllByCity(City $city): DataProviderInterface
    {
        $query = Course::find()->alias('c')->active('c')->with('mainPhoto');
        $query->andWhere(['c.city_id' => $city->id]);
        return $this->getProvider($query);
    }

    public function getAllByFirm(TeacherMainInfo $firm) :DataProviderInterface
    {
        $query = Course::find()->alias('c')->active('c')->with('mainPhoto');
        $query->andWhere(['c.firm_id' => $firm->id]);
        return $this->getProvider($query);
    }

    public function getMaxPrice() :string
    {
        /**
         * @var $course Course
         */
        $course = Course::find()->active()->orderBy(['price' => SORT_DESC])->one();
        return $course->price;
    }
    

    public function getRelated($limit, $category_id, $course_id): array
    {
        $res = Course::find()->where(['category_id' => $category_id])->andWhere(['<>', 'id', $course_id])->active()->with('mainPhoto')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
        return $res;
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


    public function search(SearchForm $form): DataProviderInterface
    {
        $pagination = new Pagination([
            'pageSizeLimit' => [15, 100],
            'validatePage' => false,
        ]);

        $sort = new Sort([
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'id',
                'price',
                'rating',
            ],
        ]);




        $response = $this->client->search([
            'index' => 'shop',
            'type' => 'courses',
            'body' => [
                '_source' => ['id'],
                'from' => $pagination->getOffset(),
                'size' => $pagination->getLimit(),
                'sort' => array_map(function ($attribute, $direction) {
                    return [$attribute => ['order' => $direction === SORT_ASC ? 'asc' : 'desc']];
                }, array_keys($sort->getOrders()), $sort->getOrders()),
                'query' => [
                    'bool' => [
                        'must' => array_merge(
                            array_filter([
//                                !empty($form->category) ? ['range' => ['categories' => ['gte' => 5, 'lte' => 6]]] : false,
                                !empty($form->to) ? ['range' => ['price' => ['gte' => $form->from, 'lte' => $form->to]]] : false,
                                !empty($form->category) ? ['term' => ['categories' => $form->category]] : false,
                                !empty($form->city) ? ['term' => ['city' => $form->city]] : false,
                                !empty($form->courseType) ? [
                                    'bool' => [
                                        'should' => array_map(function ($courseTypeItem){
                                            return ['match' => ['course_type' => $courseTypeItem]];
                                        }, $form->courseType),
                                    ],
                                ] : false,
                                !empty($form->text) ? ['match' => ['name' => $form->text]] : false,
                            ]),
                            array_map(function (ValueForm $value) {

                                return ['nested' => [
                                    'path' => 'values',
                                    'query' => [
                                        'bool' => [
                                            'must' => [
                                                'bool' => [
                                                    'should' => array_filter([
//                                                        ['match' => ['values.characteristic' => $value->getId()]],
                                                        !empty($value->equal) ? array_map(function ($val){
//                                                            VarDumper::dump(['match' => ['values.value_string' => $val]], 10, true);
                                                            return ['match' => ['values.value_string' => $val]];
                                                        }, $value->equal) : false,
                                                    ]),
                                                ],
                                            ],
                                        ],
                                    ],
                                ]];
                            }, array_filter($form->values, function (ValueForm $value) { return $value->isFilled(); }))
                        )
                    ],
                ],
            ],
        ]);



        $ids = ArrayHelper::getColumn($response['hits']['hits'], '_source.id');

        if ($ids) {
            $query = Course::find()
                ->active()
                ->with('mainPhoto')
                ->andWhere(['id' => $ids])
                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'));
        } else {
            $query = Course::find()->andWhere(['id' => 0]);
        }

        return new SimpleActiveDataProvider([
            'query' => $query,
            'totalCount' => $response['hits']['total'],
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
    }


    public function getWishList($userId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Course::find()
                ->alias('c')->active('c')
                ->joinWith('wishlistItems w', false, 'INNER JOIN')
                ->andWhere(['w.user_id' => $userId]),
            'sort' => false,
        ]);
    }
    
}