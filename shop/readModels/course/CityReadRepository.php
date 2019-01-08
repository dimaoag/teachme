<?php

namespace shop\readModels\course;

use shop\entities\shop\City;

class CityReadRepository
{
    public function find($id): ?City
    {
        return City::findOne($id);
    }
}