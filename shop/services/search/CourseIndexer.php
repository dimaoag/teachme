<?php

namespace shop\services\search;

use Elasticsearch\Client;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\Value;
use shop\repositories\shop\CategoryRepository;
use yii\helpers\ArrayHelper;


class CourseIndexer
{
    private $client;
    private $categoryRepository;

    public function __construct(Client $client, CategoryRepository $categoryRepository)
    {
        $this->client = $client;
        $this->categoryRepository = $categoryRepository;
    }

    public function clear(): void
    {
        $this->client->indices()->delete([
            'index' => 'shop'
        ]);

//        $this->client->deleteByQuery([
//            'index' => 'shop',
//            'type' => 'products',
//            'body' => [
//                'query' => [
//                    'match_all' => new \stdClass(),
//                ],
//            ],
//        ]);
    }

    public function createMapping() :void
    {
        $this->client->indices()->create([
            'index' => 'shop',
            'body' => [
                'mappings' => [
                    'courses' => [
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'name' => [
                                'type' => 'text',
                            ],
                            'price' => [
                                'type' => 'integer',
                            ],
                            'rating' => [
                                'type' => 'float',
                            ],
                            'status' => [
                                'type' => 'integer',
                            ],
                            'city' => [
                                'type' => 'integer',
                            ],
                            'course_type' => [
                                'type' => 'integer',
                            ],
                            'firm' => [
                                'type' => 'integer',
                            ],
                            'user' => [
                                'type' => 'integer',
                            ],
                            'category' => [
                                'type' => 'integer',
                            ],
                            'categories' => [
                                'type' => 'integer',
                            ],
                            'values' => [
                                'type' => 'nested',
                                'properties' => [
                                    'characteristic' => [
                                        'type' => 'integer',
                                    ],
                                    'value_string' => [
                                        'type' => 'keyword',
                                    ],
                                    'value_int' => [
                                        'type' => 'integer',
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function index(Course $course): void
    {
        $this->client->index([
            'index' => 'shop',
            'type' => 'courses',
            'id' => $course->id,
            'body' => [
                'id' => $course->id,
                'name' => $course->name,
                'price' => $course->price,
                'rating' => $course->rating,
                'status' => $course->status,
                'city' => $course->city_id,
                'course_type' => $course->course_type_id,
                'firm' => $course->firm_id,
                'user' => $course->user_id,
                'category' => $course->category->id,
                'categories' => ArrayHelper::merge(
                    [$course->category->id],
                    $course->getCategoryParents()
                ),
                'values' => array_map(function (Value $value) {
                    return [
                        'characteristic' => $value->characteristic_id,
                        'value_string' => (string)$value->value,
                        'value_int' => (int)$value->value,
                    ];
                }, $course->values),
            ],
        ]);
    }

    public function remove(Course $course): void
    {
        $this->client->delete([
            'index' => 'shop',
            'type' => 'courses',
            'id' => $course->id,
        ]);
    }
}