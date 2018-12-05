<?php

namespace shop\repositories\shop;

use phpDocumentor\Reflection\Types\Integer;
use shop\dispatchers\EventDispatcher;
use shop\entities\shop\course\Course;
use shop\repositories\events\EntityPersisted;
use shop\repositories\events\EntityRemoved;
use shop\repositories\NotFoundException;

class CourseRepository
{

    public function get($id): Course
    {
        if (!$course = Course::findOne($id)) {
            throw new NotFoundException('Course is not found.');
        }
        return $course;
    }

    public function getCoursesByUserId($id)
    {
        if (!$courses = Course::find()->andWhere(['user_id' => $id])->all()) {
            throw new NotFoundException('Course is not found.');
        }
        return $courses;
    }

    public function existsByCity($id): bool
    {
        return Course::find()->andWhere(['city_id' => $id])->exists();
    }

    public function existsByMainCategory($id): bool
    {
        return Course::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Course $course): void
    {
        if (!$course->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Course $course): void
    {
        if (!$course->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}