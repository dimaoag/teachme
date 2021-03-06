<?php

namespace shop\forms\manage\shop\course;

use yii\base\Model;
use yii\web\UploadedFile;

class GalleryForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $gallery;

    public function rules(): array
    {
        return [
            ['gallery', 'each', 'rule' => ['file', 'extensions' => 'jpeg ,jpg, png', 'mimeTypes' => 'image/jpeg, image/png']],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->gallery = UploadedFile::getInstances($this, 'gallery');
            return true;
        }
        return false;
    }
}