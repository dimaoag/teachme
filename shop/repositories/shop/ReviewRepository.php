<?php

namespace shop\repositories\shop;

use shop\entities\shop\course\Review;
use shop\repositories\NotFoundException;

class ReviewRepository
{
    public function get($id): Review
    {
        if (!$review = Review::findOne($id)) {
            throw new NotFoundException('Review is not found.');
        }
        return $review;
    }

    public function save(Review $city): void
    {
        if (!$city->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Review $city): void
    {
        if (!$city->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}