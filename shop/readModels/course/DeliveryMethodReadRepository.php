<?php

namespace shop\readModels\course;

use shop\entities\shop\DeliveryMethod;

class DeliveryMethodReadRepository
{
    public function getAll(): array
    {
        return DeliveryMethod::find()->orderBy('sort')->all();
    }
}