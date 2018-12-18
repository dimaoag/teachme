<?php

namespace shop\forms\course;



use yii\base\Model;


class ReviewForm extends Model
{
    public $vote;
    public $text;

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => $this->votesList()],
            ['text', 'string'],
        ];
    }

    public function votesList(): array
    {
        return [1,2,3,4,5];
    }
}