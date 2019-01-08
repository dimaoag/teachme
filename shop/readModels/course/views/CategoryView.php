<?php

namespace shop\readModels\course\views;

use shop\entities\shop\Category;

class CategoryView
{
    public $category;
    public $count;

    public function __construct(Category $category, $count)
    {
        $this->category = $category;
        $this->count = $count;
    }
}