<?php

namespace shop\entities\shop\course;

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
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
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
        return '{{%course_photos}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/courses/[[attribute_course_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/courses/[[attribute_course_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/courses/[[attribute_course_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/courses/[[attribute_course_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'favorite_list' => ['width' => 150, 'height' => 150],
                    'favorite_widget_list' => ['width' => 57, 'height' => 57],
                    'search_list' => ['width' => 400, 'height' => 228],
//                    'catalog_product_main' => ['processor' => function (GD $thumb){
//                        $thumb->adaptiveResize(750,1000);  // my resize
//                    }],

                ],
            ],
        ];
    }
}