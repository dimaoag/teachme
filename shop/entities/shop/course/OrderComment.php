<?php

namespace shop\entities\shop\course;

use shop\entities\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $order_id
 * @property string $text
 * @property int $status
 * @property int $created_at
 *
 * @property Order $order
 */
class OrderComment extends ActiveRecord
{
    public static function create(int $orderId,string $text): self
    {
        $orderComment = new static();
        $orderComment->order_id = $orderId;
        $orderComment->text = $text;
        $orderComment->status = null;
        $orderComment->created_at = time();
        return $orderComment;
    }


    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }



    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }


    public static function tableName(): string
    {
        return '{{%course_order_comments}}';
    }
}