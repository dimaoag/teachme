<?php

namespace shop\entities\shop\course;

use Imagick;
use PHPThumb\GD;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class Gallery extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $gallery = new static();
        $gallery->file = $file;
        return $gallery;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%course_galleries}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/galleries/[[attribute_course_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/galleries/[[attribute_course_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/galleries/[[attribute_course_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/galleries/[[attribute_course_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'preview' => ['processor' => function (GD $thumb){
                        $thumb->setOptions([
                            'jpegQuality' => 75,
                        ]);

                        $thumb->adaptiveResize(1000,750);  // my resize

                    }],

                ],
            ],
        ];
    }
}