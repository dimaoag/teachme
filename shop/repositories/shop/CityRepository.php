<?php

namespace shop\repositories\shop;

use shop\entities\shop\City;
use shop\repositories\NotFoundException;

class CityRepository
{
    public function get($id): City
    {
        if (!$city = City::findOne($id)) {
            throw new NotFoundException('City is not found.');
        }
        return $city;
    }

    public function save(City $city): void
    {
        if (!$city->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(City $city): void
    {
        if (!$city->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}