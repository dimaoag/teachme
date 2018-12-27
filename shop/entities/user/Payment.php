<?php

namespace shop\entities\user;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use shop\entities\shop\CourseType;

/**
 * @property int $id
 * @property int $course_type_id
 * @property int $user_id
 * @property int $price
 * @property int $quantity
 * @property int $sum
 * @property int $status
 * @property int $created_at
 *
 * @property CourseType $courseType
 * @property User $user
 */
class Payment extends ActiveRecord
{
    const NEW = 1;
    const COMPLETED = 2;
    const CANCELLED = 3;

    public static function create($courseTypeId, $userId, $price, $quantity, $sum): self
    {
        $payment = new static();
        $payment->course_type_id= $courseTypeId;
        $payment->user_id= $userId;
        $payment->price = $price;
        $payment->quantity = $quantity;
        $payment->sum = $sum;
        $payment->status = self::NEW;
        $payment->created_at = time();
        return $payment;
    }

    public function isCompleted(): bool
    {
        return $this->status == self::COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status == self::CANCELLED;
    }


    public function statusCompleted(): void
    {
        if ($this->isCompleted()) {
            throw new \DomainException('Payment is already completed.');
        }
        $this->status = self::COMPLETED;
    }

    public function statusCancelled(): void
    {
        if ($this->isCancelled()) {
            throw new \DomainException('Payment is already cancelled.');
        }
        $this->status = self::CANCELLED;
    }




    public function getCourseType(): ActiveQuery
    {
        return $this->hasOne(CourseType::class, ['id' => 'course_type_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function tableName(): string
    {
        return '{{%user_payments}}';
    }
}