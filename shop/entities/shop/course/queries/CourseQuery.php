<?php

namespace shop\entities\shop\course\queries;

use shop\entities\shop\course\Course;
use yii\db\ActiveQuery;

class CourseQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Course::STATUS_ACTIVE,
        ]);
    }
}