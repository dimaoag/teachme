<?php

namespace shop\repositories\shop;

use shop\entities\shop\course\PriceModification;
use shop\repositories\NotFoundException;

class PriceModificationRepository
{
    public function get($id): PriceModification
    {
        if (!$priceModification = PriceModification::findOne($id)) {
            throw new NotFoundException('PriceModification is not found.');
        }
        return $priceModification;
    }

    public function save(PriceModification $priceModification): void
    {
        if (!$priceModification->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(PriceModification $priceModification): void
    {
        if (!$priceModification->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}