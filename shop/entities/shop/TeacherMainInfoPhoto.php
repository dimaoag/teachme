<?php
namespace shop\entities\shop;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $file
 *
 * @mixin ImageUploadBehavior
 */

class TeacherMainInfoPhoto  extends  ActiveRecord{

    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }



    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%teacher_main_info_photos}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/teacher_main_info/[[attribute_teacher_main_info_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/teacher_main_info/[[attribute_teacher_main_info_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/teacher_main_info/[[attribute_teacher_main_info_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/teacher_main_info/[[attribute_teacher_main_info_id]]/[[profile]]_[[id]].[[extension]]',
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