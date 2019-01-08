<?php

namespace shop\readModels\course;

use Elasticsearch\Client;
use shop\entities\shop\Category;
use shop\readModels\course\views\CategoryView;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class CategoryReadRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRoot(): Category
    {
        return Category::find()->roots()->one();
    }

    /**
     * @return Category[]
     */
    public function getAll(): array
    {
        return Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->all();
    }

    public function find($id): ?Category
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeWithSubsOf(): array
    {
        $query = Category::find()->where(['depth' => 1])->orderBy('lft'); //without root category

        $aggs = $this->client->search([
            'index' => 'shop',
            'type' => 'courses',
            'body' => [
                'size' => 0,
                'aggs' => [
                    'group_by_category' => [
                        'terms' => [
                            'field' => 'categories',
                        ]
                    ]
                ],
            ],
        ]);



        $counts = ArrayHelper::map($aggs['aggregations']['group_by_category']['buckets'], 'key', 'doc_count');


        return array_map(function (Category $category) use ($counts) {
            return new CategoryView($category, ArrayHelper::getValue($counts, $category->id, 0));
        }, $query->all());
    }



}