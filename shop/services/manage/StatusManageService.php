<?php

namespace shop\services\manage;

use shop\entities\shop\Status;
use shop\forms\manage\shop\StatusForm;
use shop\repositories\shop\StatusRepository;

class StatusManageService
{
    private $statuses;

    public function __construct(StatusRepository $statuses)
    {
        $this->statuses = $statuses;
    }

    public function create(StatusForm $form): Status
    {
        $status = Status::create($form->name);
        $this->statuses->save($status);
        return $status;
    }

    public function edit($id, StatusForm $form): void
    {
        $status = $this->statuses->get($id);
        $status->edit($form->name);
        $this->statuses->save($status);
    }

    public function remove($id): void
    {
        $status = $this->statuses->get($id);
//        if ($this->products->existsByBrand($brand->id)) {
//            throw new \DomainException('Unable to remove brand with products.');
//        }
        $this->statuses->remove($status);
    }
}