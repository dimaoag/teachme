<?php

namespace shop\repositories\shop;

use shop\entities\shop\course\Order;
use shop\repositories\NotFoundException;

class OrderRepository
{
    public function get($id): Order
    {
        if (!$order = Order::findOne($id)) {
            throw new NotFoundException('Review is not found.');
        }
        return $order;
    }

    public function getOrdersByTeacherId($id)
    {
        if (!$orders = Order::find()->andWhere(['teacher_id' => $id])->all()) {
            return false;
        }
        return $orders;
    }

    public function getOrdersByTeacherIdAndCourseId($id, $course_id)
    {
        if (!$orders = Order::find()->andWhere(['teacher_id' => $id, 'course_id' => $course_id])->all()) {
            return false;
        }
        return $orders;
    }

    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Order $order): void
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}