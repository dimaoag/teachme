<?php

namespace shop\services\manage;

use shop\entities\shop\CourseType;
use shop\forms\manage\shop\CourseTypeForm;
use shop\repositories\shop\CourseTypeRepository;

class CourseTypeManageService
{
    private $courseTypes;

    public function __construct(CourseTypeRepository $courseTypes)
    {
        $this->courseTypes = $courseTypes;
    }

    public function create(CourseTypeForm $form): CourseType
    {
        $courseType = CourseType::create(
            $form->name,
            $form->price,
            $form->old_price,
            $form->sort
        );
        $this->courseTypes->save($courseType);
        return $courseType;
    }

    public function edit($id, CourseTypeForm $form): void
    {
        $courseType = $this->courseTypes->get($id);
        $courseType->edit(
            $form->name,
            $form->price,
            $form->old_price,
            $form->sort
        );
        $this->courseTypes->save($courseType);
    }

    public function remove($id): void
    {
        $courseType = $this->courseTypes->get($id);
        $this->courseTypes->remove($courseType);
    }
}