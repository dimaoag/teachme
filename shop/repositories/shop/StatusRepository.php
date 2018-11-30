<?php

namespace shop\repositories\shop;

use shop\entities\shop\Status;
use shop\repositories\NotFoundException;

class StatusRepository
{
    public function get($id): Status
    {
        if (!$status = Status::findOne($id)) {
            throw new NotFoundException('Status is not found.');
        }
        return $status;
    }

    public function save(Status $status): void
    {
        if (!$status->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Status $status): void
    {
        if (!$status->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}