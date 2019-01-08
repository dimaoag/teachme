<?php

namespace shop\readModels\course;

use shop\entities\shop\TeacherMainInfo;

class TeacherMainInfoReadRepository
{
    public function find($id): ?TeacherMainInfo
    {
        return TeacherMainInfo::findOne($id);
    }

}