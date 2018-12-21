<?php

namespace shop\repositories\shop;

use shop\entities\shop\course\OrderComment;
use shop\repositories\NotFoundException;

class OrderCommentRepository
{
    public function get($id): OrderComment
    {
        if (!$orderComment = OrderComment::findOne($id)) {
            throw new NotFoundException('Review is not found.');
        }
        return $orderComment;
    }


    public function getOrderCommentsByOrderId($id)
    {
        if (!$orderComments = OrderComment::find()->andWhere(['order_id' => $id])->all()) {
            return false;
        }
        return $orderComments;
    }

    public function save(OrderComment $orderComment): void
    {
        if (!$orderComment->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(OrderComment $orderComment): void
    {
        if (!$orderComment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}