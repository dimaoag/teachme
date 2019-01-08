<?php

namespace frontend\widgets\course;

use shop\readModels\course\CourseReadRepository;
use yii\base\Widget;

class RelatedCoursesWidget extends Widget
{
    public $limit;
    public $category_id;
    public $course_id;

    private $repository;

    public function __construct(CourseReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('related', [
            'courses' => $this->repository->getRelated($this->limit, $this->category_id, $this->course_id)
        ]);
    }
}