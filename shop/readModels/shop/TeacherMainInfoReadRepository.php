<?php

namespace shop\readModels\shop;

use shop\entities\shop\TeacherMainInfo;

class TeacherMainInfoReadRepository
{
    public function find($id): ?TeacherMainInfo
    {
        return TeacherMainInfo::findOne($id);
    }

}