<?php

namespace shop\repositories\shop;

use shop\entities\shop\course\Error;
use shop\repositories\NotFoundException;

class ErrorRepository
{
    public function get($id): Error
    {
        if (!$error = Error::findOne($id)) {
            throw new NotFoundException('Error is not found.');
        }
        return $error;
    }

    public function getByCourseId($id): Error
    {
        if (!$error = Error::find()->andWhere(['course_id' => $id])->limit(1)->one()) {
            throw new NotFoundException('Error is not found.');
        }
        return $error;
    }

    public function save(Error $error): void
    {
        if (!$error->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Error $error): void
    {
        if (!$error->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}