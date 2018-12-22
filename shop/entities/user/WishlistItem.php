<?php

namespace shop\entities\user;

use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property integer $course_id
 */
class WishlistItem extends ActiveRecord
{
    public static function create($courseId)
    {
        $item = new static();
        $item->course_id = $courseId;
        return $item;
    }

    public function isForCourse($courseId): bool
    {
        return $this->course_id == $courseId;
    }

    public function isForUser($userId): bool
    {
        return $this->user_id == $userId;
    }

    public static function tableName(): string
    {
        return '{{%user_wishlist_items}}';
    }
}