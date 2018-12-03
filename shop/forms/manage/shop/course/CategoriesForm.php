<?php

namespace shop\forms\manage\shop\course;

use shop\entities\shop\Category;
use shop\entities\shop\course\Course;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoriesForm extends Model
{
    public $main;

    public function __construct(Course $course = null, $config = [])
    {
        if ($course) {
            $this->main = $course->category_id;
        }
        parent::__construct($config);
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function rules(): array
    {
        return [
            ['main', 'required'],
            ['main', 'integer'],
        ];
    }

}