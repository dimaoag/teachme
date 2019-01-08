<?php

namespace shop\readModels\course;

use shop\entities\shop\Tag;

class TagReadRepository
{
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}