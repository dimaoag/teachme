<?php

namespace shop\readModels\course;

use shop\entities\shop\Brand;

class BrandReadRepository
{
    public function find($id): ?Brand
    {
        return Brand::findOne($id);
    }
}