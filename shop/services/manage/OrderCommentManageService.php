<?php

namespace shop\services\manage;

use shop\entities\shop\course\OrderComment;
use shop\forms\course\order\OrderCommentCreateForm;
use shop\repositories\shop\OrderCommentRepository;

class OrderCommentManageService
{
    private $orderComments;

    public function __construct(OrderCommentRepository $orderComments)
    {
        $this->orderComments = $orderComments;
    }

    public function create(OrderCommentCreateForm $form): OrderComment
    {
        $orderComment = OrderComment::create($form->order_id, $form->text);
        $this->orderComments->save($orderComment);
        return $orderComment;
    }


    public function remove($id): void
    {
        $orderComment = $this->orderComments->get($id);
        $this->orderComments->remove($orderComment);
    }
}