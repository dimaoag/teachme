<?php

namespace shop\repositories\shop;


use shop\entities\shop\course\Course;
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

    public function existsByPriceModification($id): bool
    {
        return Course::find()->andWhere(['price_modification_id' => $id])->exists();
    }


    public function getCoursesByUserId($id)
    {
        if (!$courses = Course::find()->andWhere(['user_id' => $id])->all()) {
            return false;
        }
        return $courses;
    }

    public function getCoursesByFirmId($id)
    {
        if (!$courses = Course::find()->andWhere(['firm_id' => $id])->all()) {
            return false;
        }
        return $courses;
    }

    public function existsByCity($id): bool
    {
        return Course::find()->andWhere(['city_id' => $id])->exists();
    }

    public function existsByCourseType($id): bool
    {
        return Course::find()->andWhere(['course_type_id' => $id])->exists();
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