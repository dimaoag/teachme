<?php

namespace shop\entities\shop\course;

use shop\entities\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $course_id
 * @property int $teacher_id
 * @property string $username
 * @property string $phone
 * @property string $title
 * @property float $price
 * @property int $status
 * @property int $created_at
 *
 * @property User $user
 * @property Course $course
 * @property OrderComment[] $orderComments
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED = 2;

    public static function create(int $teacherId,string $username, string $phone, string $title, float $price): self
    {
        $order = new static();
        $order->teacher_id = $teacherId;
        $order->username = $username;
        $order->phone = $phone;
        $order->title = $title;
        $order->price = $price;
        $order->status = self::STATUS_NEW;
        $order->created_at = time();
        return $order;
    }

    public function edit($title, $status): void
    {
        $this->title = $title;
        $this->status = $status;
    }

    public function asNew(): void
    {
        $this->status = self::STATUS_NEW;
    }

    public function asProcessing(): void
    {
        $this->status = self::STATUS_PROCESSING;
    }

    public function asCompleted(): void
    {
        $this->status = self::STATUS_COMPLETED;
    }


    public function isNew(): bool
    {
        return $this->status == self::STATUS_NEW;
    }

    public function isProcessing(): bool
    {
        return $this->status == self::STATUS_PROCESSING;
    }

    public function isCompleted(): bool
    {
        return $this->status == self::STATUS_COMPLETED;
    }



    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }


    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }

    public function getCourse(): ActiveQuery
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    public function getOrderComments(): ActiveQuery
    {
        return $this->hasMany(OrderComment::class, ['order_id' => 'id']);
    }


    public static function tableName(): string
    {
        return '{{%course_orders}}';
    }
}