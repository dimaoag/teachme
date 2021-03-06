<?php

namespace shop\entities\shop\course;

use yii\db\ActiveRecord;
/**
 * @property integer $id
 * @property integer $course_id
 * @property string $message
 * @property integer $status
 */
class Error extends ActiveRecord
{

    public static function create($courseId, $message): self
    {
        $error = new static();
        $error->course_id = $courseId;
        $error->message = $message;
        return $error;
    }

    public function edit($message): void
    {
        $this->message = $message;
    }



    public static function tableName(): string
    {
        return '{{%course_errors}}';
    }


}