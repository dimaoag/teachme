<?php

namespace shop\services\manage;

use shop\entities\shop\course\PriceModification;
use shop\forms\manage\shop\course\PriceModificationForm;
use shop\repositories\shop\CourseRepository;
use shop\repositories\shop\PriceModificationRepository;

class PriceModificationManageService
{
    private $priceModifications;
    private $courses;

    public function __construct(PriceModificationRepository $priceModificationRepository, CourseRepository $courseRepository)
    {
        $this->priceModifications = $priceModificationRepository;
        $this->courses = $courseRepository;
    }


    public function create(PriceModificationForm $form): PriceModification
    {
        $priceModification = PriceModification::create($form->title);
        $this->priceModifications->save($priceModification);
        return $priceModification;
    }


    public function edit($id, PriceModificationForm $form): void
    {
        $priceModification = $this->priceModifications->get($id);
        $priceModification->edit($form->title);
        $this->priceModifications->save($priceModification);
    }

    public function remove($id): void
    {
        $priceModification = $this->priceModifications->get($id);
        if ($this->courses->existsByPriceModification($priceModification->id)) {
            throw new \DomainException('Unable to remove priceModification with courses.');
        }
        $this->priceModifications->remove($priceModification);
    }
}