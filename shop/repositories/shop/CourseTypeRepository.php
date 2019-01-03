<?php

namespace shop\repositories\shop;

use shop\entities\shop\CourseType;
use shop\repositories\NotFoundException;

class CourseTypeRepository
{
    public function get($id): CourseType
    {
        if (!$courseType = CourseType::findOne($id)) {
            throw new NotFoundException('Type course is not found.');
        }
        return $courseType;
    }

    public function save(CourseType $courseType): void
    {
        if (!$courseType->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(CourseType $courseType): void
    {
        if (!$courseType->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}