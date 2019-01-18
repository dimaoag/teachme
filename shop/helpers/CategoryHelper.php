<?php
namespace shop\helpers;


use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\Category;



class CategoryHelper
{

    public static function CategoriesListLg(){

        $categories = Category::find()->where(['>', 'depth', 0])->addOrderBy( 'lft')->all();
        $level=0;

        foreach($categories as $n=>$category)
        {
            $class = ($category->id ==0) ?  'root-category' : ' ';
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
            echo "<a href='".Url::to(['/course/search/search', 'category' =>$category->id])."'>"
                    ."<p>".Html::encode($category->name)."</p>"
                    .'<svg xmlns="http://www.w3.org/2000/svg" width="5.13" height="9.59" viewBox="0 0 5.13 9.59">
                        <g id="right-arrow" transform="translate(0 9.59) rotate(-90)">
                            <path id="Path_27" class="cat-menu-right-arrow-svg" data-name="Path 27" d="M6.5,33.5a.339.339,0,0,1,.479,0L11.19,37.72,15.412,33.5a.339.339,0,1,1,.479.479l-4.453,4.453a.331.331,0,0,1-.24.1.345.345,0,0,1-.24-.1L6.506,33.978A.332.332,0,0,1,6.5,33.5Z" transform="translate(-6.4 -33.4)"/>
                        </g>
                     </svg>'
                ."</a>";
            $level=$category->depth;
        }

        for($i=$level;$i;$i--)
        {
            echo '</li>';
            echo '</ul>';
        }
    }

    public static function CategoriesListSm(){

        $categories = Category::find()->where(['>', 'depth', 0])->addOrderBy( 'lft')->all();
        $level=0;
        $i = 0;

        foreach($categories as $n=>$category)
        {
            $class = !$i  ? 'dl-menu' : 'dl-submenu';
            /** @var Category $category */
            if($category->depth==$level)
                echo "<li>"."\n";
            else if($category->depth>$level)
                echo '<ul class="'. $class .'">'."\n";
            else
            {
                echo "</li>"."\n";

                for($i=$level-$category->depth;$i;$i--)
                {
                    echo '</ul>'."\n";
                    echo "</li>"."\n";
                }
            }

            echo "<li>";
            echo "<a href='".Url::to(['/course/search/search', 'category' =>$category->id])."'>"
                ."<p>".Html::encode($category->name)."</p>"
                .'<svg xmlns="http://www.w3.org/2000/svg" width="5.13" height="9.59" viewBox="0 0 5.13 9.59">
                        <g id="right-arrow" transform="translate(0 9.59) rotate(-90)">
                            <path id="Path_27" class="cat-menu-right-arrow-svg" data-name="Path 27" d="M6.5,33.5a.339.339,0,0,1,.479,0L11.19,37.72,15.412,33.5a.339.339,0,1,1,.479.479l-4.453,4.453a.331.331,0,0,1-.24.1.345.345,0,0,1-.24-.1L6.506,33.978A.332.332,0,0,1,6.5,33.5Z" transform="translate(-6.4 -33.4)"/>
                        </g>
                     </svg>'
                ."</a>";
            $level=$category->depth;
            $i++;
        }

        for($i=$level;$i;$i--)
        {
            echo '</li>';
            echo '</ul>';
        }

    }


}