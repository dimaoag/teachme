<?php
namespace shop\helpers;


use shop\repositories\shop\CourseRepository;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\course\Course;


class CourseHelper
{
    public static function isUserCourse($courseId, $userId){
        $repository = new CourseRepository();
        $course = $repository->get($courseId);
        return $course->user_id = $userId ? true : false;
    }


    public static function getStatus($status){

        switch ($status){
            case Course::STATUS_NOT_ACTIVE:
                $res = 'Неактивный';
                break;
            case Course::STATUS_ON_MODERATION:
                $res = 'На модерации';
                break;
            case Course::STATUS_ACTIVE:
                $res = 'Активный';
                break;
            case Course::STATUS_FAIL:
                $res = 'Отклонено';
                break;
            default:
                $res = null;
        }
        return $res;
    }

    public static function getStatusLink($status, $courseId){


        $isDisableClass = UserHelper::checkPublications(Yii::$app->user->id) ? "" : 'disabled="disabled" style="pointer-events: none; opacity: 0.5;"';

        switch ($status){
            case Course::STATUS_NOT_ACTIVE:
                $res = '<a href="'. Url::to(['/course/course/on-moderation', 'id' => $courseId]) .'" class="add" '. $isDisableClass .' data-method="post">Активировать</a>';
                break;

            case Course::STATUS_ON_MODERATION:
                $res = '<a href="#" class="add" disabled="disabled" style="pointer-events: none; opacity: 0.5;">На модерации</a>';
                break;

            case Course::STATUS_ACTIVE:
                $res = Html::a('Деактивировать', ['/course/course/disable', 'id' => $courseId], [
                    'class' => 'add',
                    'data' => [
                        'confirm' => 'Вы действительно хотите деактивировать курс?',
                        'method' => 'post',
                    ],
                ]);
                break;

            case Course::STATUS_FAIL:
                $res = '<a href="'. Url::to(['/course/course/on-moderation', 'id' => $courseId]) .'" class="add" '. $isDisableClass .' data-method="post">Активировать</a>';
                break;
            default:
                $res = null;
        }
        return $res;
    }




}