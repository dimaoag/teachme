<?php

namespace shop\entities\shop\course;

use shop\entities\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 * @property int $created_at
 *
 *
 * @property User $user
 */
class Review extends ActiveRecord
{
    public static function create($userId, int $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = true;
        return $review;
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
        return '{{%course_reviews}}';
    }
}