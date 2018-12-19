<?php

namespace shop\entities\shop\course;

use shop\entities\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $course_id
 * @property string $username
 * @property string $phone
 * @property string $title
 * @property float $price
 * @property int $status
 * @property int $created_at
 *
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED = 2;

    public static function create(string $username, string $phone, string $title, float $price): self
    {
        $order = new static();
        $order->username = $username;
        $order->phone = $phone;
        $order->title = $title;
        $order->price = $price;
        $order->status = self::STATUS_NEW;
        $order->created_at = time();
        return $order;
    }

    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = true;
    }

    public function isActive(): bool
    {
        return $this->active == true;
    }

    public function getRating(): int
    {
        return $this->vote;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function isOwner($userId):bool
    {
        return $this->user_id == $userId;
    }


    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public static function tableName(): string
    {
        return '{{%course_orders}}';
    }
}