<?php
namespace shop\helpers;


use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\Category;



class CategoryHelper
{

    public static function CategoriesList(){

        $categories = Category::find()->addOrderBy( 'lft')->all();
        $level=1;

        foreach($categories as $n=>$category)
        {
            $class = ($category->id ==1) ?  'root-category' : ' ';
            /** @var Category $category */
            if($category->depth==$level)
                echo "<li>"."\n";
            else if($category->depth>$level)
                echo '<ul>'."\n";
            else
            {
                echo "</li>"."\n";

                for($i=$level-$category->depth;$i;$i--)
                {
                    echo '</ul>'."\n";
                    echo "</li>"."\n";
                }
            }

            echo "<li class='" . $class. "'>";
            echo "<a href='/category/".$category->id ."'>" . $category->name ."</a>";
            $level=$category->depth;
        }

        for($i=$level;$i;$i--)
        {
            echo '</li>';
            echo '</ul>';
        }

    }


}