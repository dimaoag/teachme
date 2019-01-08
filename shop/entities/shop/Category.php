<?php

namespace shop\entities\shop;

use paulzi\nestedsets\NestedSetsBehavior;
use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use shop\entities\shop\queries\CategoryQuery;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\helpers\Inflector;
/**
 * @property integer $id
 * @property string $name
 * @property string $cat_photo
 * @property string $slug
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 *
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 * @mixin ImageUploadBehavior
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = Inflector::slug($name, '_');
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = Inflector::slug($name, '_');
        $this->meta = $meta;
    }


    // Photo

    public function addPhoto(UploadedFile $file): void
    {
        $this->cat_photo = $file;
    }


    public function removePhoto($id): void
    {
        $this->cleanFiles();
        Yii::$app->db->createCommand("UPDATE course_categories SET cat_photo = NULL WHERE id = $id")->execute();
    }


    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->name ?: $this->name;
    }

    public static function tableName(): string
    {
        return '{{%course_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            NestedSetsBehavior::className(),
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'cat_photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/category/[[attribute_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/category/[[attribute_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/category/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/category/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
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

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}