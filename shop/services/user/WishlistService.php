<?php

namespace shop\services\user;

use shop\repositories\shop\CourseRepository;
use shop\repositories\UserRepository;

class WishlistService
{
    private $users;
    private $courses;

    public function __construct(UserRepository $users, CourseRepository $courses)
    {
        $this->users = $users;
        $this->courses = $courses;
    }

    public function add($userId, $courseId): void
    {
        $user = $this->users->getUserById($userId);
        $course = $this->courses->get($courseId);
        $user->addToWishList($course->id);
        $this->users->save($user);
    }

    public function remove($userId, $courseId): void
    {
        $user = $this->users->getUserById($userId);
        $course = $this->courses->get($courseId);
        $user->removeFromWishList($course->id);
        $this->users->save($user);
    }
}