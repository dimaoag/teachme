<?php

namespace shop\repositories\shop;

use shop\entities\shop\TeacherMainInfo;
use shop\repositories\NotFoundException;

class TeacherMainInfoRepository
{
    public function get($id): TeacherMainInfo
    {
        if (!$teacherMainInfo = TeacherMainInfo::findOne($id)) {
            throw new NotFoundException('Information is not found.');
        }
        return $teacherMainInfo;
    }



    public function getTeacherMainInfoByUserId($id)
    {
        if (!$teacherMainInfo = TeacherMainInfo::find()->andWhere(['user_id' => $id])->one()) {
            return false;
        }
        return $teacherMainInfo;
    }

    public function save(TeacherMainInfo $teacherMainInfo): void
    {
        if (!$teacherMainInfo->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(TeacherMainInfo $teacherMainInfo): void
    {
        if (!$teacherMainInfo->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}