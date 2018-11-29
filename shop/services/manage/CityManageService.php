<?php

namespace shop\services\manage;

use shop\entities\Meta;
use shop\entities\shop\City;
use shop\forms\manage\shop\CityForm;
use shop\repositories\shop\CityRepository;

class CityManageService
{
    private $cities;

    public function __construct(CityRepository $cities)
    {
        $this->cities = $cities;
    }

    public function create(CityForm $form): City
    {
        $city = City::create(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->cities->save($city);
        return $city;
    }

    public function edit($id, CityForm $form): void
    {
        $city = $this->cities->get($id);
        $city->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->cities->save($city);
    }

    public function remove($id): void
    {
        $city = $this->cities->get($id);
//        if ($this->products->existsByBrand($brand->id)) {
//            throw new \DomainException('Unable to remove brand with products.');
//        }
        $this->cities->remove($city);
    }
}