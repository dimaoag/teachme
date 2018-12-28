<?php

namespace console\controllers;

use Elasticsearch\Common\Exceptions\Missing404Exception;
use shop\entities\shop\course\Course;
use shop\services\search\CourseIndexer;
use yii\console\Controller;
use shop\repositories\shop\CourseRepository;

class SearchController extends Controller
{
    private $indexer;
    private $courses;

    public function __construct($id, $module, CourseIndexer $indexer, CourseRepository $courses, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->indexer = $indexer;
        $this->courses = $courses;
    }


    public function actionReindex(): void
    {
        $query = Course::find()
            ->active()
            ->with(['category', 'user' , 'city' , 'values'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try {
            $this->indexer->clear();
        } catch (Missing404Exception $e){
            $this->stdout('Index is Empty' . PHP_EOL);
        }


        $this->stdout('Indexing of products' . PHP_EOL);

        $this->indexer->createMapping();

        foreach ($query->each() as $course) {
            /** @var Course $course */
            $this->stdout('Course #' . $course->id . PHP_EOL);
            $this->indexer->index($course);
//            $this->indexer->remove($course);
        }


        $this->stdout('Done!' . PHP_EOL);
    }



    public function actionCheckDate(): void
    {
        $query = Course::find()
            ->active()
            ->orderBy('id');

        $this->stdout('Indexing of products' . PHP_EOL);

        foreach ($query->each() as $course) {
            /** @var Course $course */
            $currentDate = time();
            $this->stdout('Course #' . $course->id . PHP_EOL);
            if ($currentDate > $course->date_stop_sale){
                $course->deactivate();
                $this->courses->save($course);
                $this->indexer->remove($course);
            }
        }

        $this->stdout('Done!' . PHP_EOL);
    }




}