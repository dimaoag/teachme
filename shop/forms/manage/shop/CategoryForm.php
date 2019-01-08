<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\Category;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta;
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $parentId;
    /**
     * @var  UploadedFile $firm_photo
     */
    public $cat_photo;

    private $_category;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['parentId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null],
            [['cat_photo'], 'image'],
        ];
    }

    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function internalForms(): array
    {
        return ['meta'];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'cat_photo' => 'Фото',
            'parentId' => 'Родительская категория',
        ];
    }


    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->cat_photo = UploadedFile::getInstance($this, 'cat_photo');
            return true;
        }
        return false;
    }






}