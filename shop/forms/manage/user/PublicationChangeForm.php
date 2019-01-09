<?php

namespace shop\forms\manage\user;




use shop\entities\user\Publication;
use yii\base\Model;

class PublicationChangeForm extends Model
{
    public $courseTypeId;
    public $userId;
    public $quantity;

    private $_publication;

    public function __construct(Publication $publication = null, $config = [])
    {
        if ($publication) {
            $this->courseTypeId = $publication->course_type_id;
            $this->userId = $publication->user_id;
            $this->quantity = $publication->quantity;
            $this->_publication = $publication;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['courseTypeId', 'userId', 'quantity'], 'required'],
            [['courseTypeId', 'userId', 'quantity'], 'integer'],
            [['quantity'], 'integer' ,'min' => 0],
        ];
    }


    public function attributeLabels()
    {
        return [
            'quantity' => 'Количество',
        ];
    }

}