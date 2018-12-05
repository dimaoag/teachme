<?php
namespace shop\helpers;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\course\Course;


class CourseHelper
{

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

        $isDisableClass = (Yii::$app->user->identity->publications > 0) ? "" : 'disabled="disabled" style="pointer-events: none; opacity: 0.5;"';

        switch ($status){
            case Course::STATUS_NOT_ACTIVE:
                $res = '<a href="'. Url::to(['/course/course/on-moderation', 'id' => $courseId]) .'" class="add" '. $isDisableClass .' data-method="post">Активировать</a>';
                break;

            case Course::STATUS_ON_MODERATION:
                $res = '<a href="#" class="add disabled" data-method="post">На модерации</a>';
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



//    public static function statusList(): array {
//        return [
//            User::STATUS_WAIT => 'Не подтвержденные',
//            User::STATUS_ACTIVE => 'Активные',
//        ];
//    }
//
//    public static function designationList(): array {
//        return [
//            User::LEARNER => 'Пользователь',
//            User::TEACHER => 'Школа',
//        ];
//    }
//
//
//    public static function statusName($status):string {
//        return ArrayHelper::getValue(self::statusList(), $status);
//    }
//
//    public static function statusLabel($status):string {
//        switch ($status){
//            case User::STATUS_WAIT:
//                $class = 'label label-default';
//                break;
//            case User::STATUS_ACTIVE:
//                $class = 'label label-success';
//                break;
//            default:
//                $class = 'label label-default';
//        }
//        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
//            'class' => $class,
//        ]);
//    }
//
//    public static function designationValue($designation):string {
//        switch ($designation){
//            case User::LEARNER:
//                $designationValue = 'Пользователь';
//                break;
//            case User::TEACHER:
//                $designationValue = 'Школа';
//                break;
//        }
//        return $designationValue;
//    }
//
//
//    public static function echoDate($date){
////        Yii::$app->formatter->locale = 'en-EN';
//        return Yii::$app->formatter->asDatetime($date,'medium');
//    }
//
//
//    public static function isAccessAddCourse() :bool
//    {
//        if (Yii::$app->user->isGuest || Yii::$app->user->identity->designation != User::TEACHER){
//            return false;
//        }
//        return true;
//    }
//
//    public static function isUserTeacher() :bool
//    {
//        if (Yii::$app->user->identity->designation == User::TEACHER){
//            return true;
//        }
//        return false;
//    }
//
//    public static function getCabinetLink(){
//
//        switch (Yii::$app->user->identity->designation){
//            case User::LEARNER:
//                return Url::to(['/cabinet/learner']);
//                break;
//            case User::TEACHER:
//                return Url::to(['/cabinet/teacher']);
//                break;
//
//            default:
//                return Url::to(['/']);
//        }
//    }


}