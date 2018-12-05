<?php
namespace shop\helpers;

use shop\entities\user\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
class UserHelper
{
    public static function statusList(): array {
        return [
            User::STATUS_WAIT => 'Не подтвержденные',
            User::STATUS_ACTIVE => 'Активные',
        ];
    }

    public static function designationList(): array {
        return [
            User::LEARNER => 'Пользователь',
            User::TEACHER => 'Школа',
        ];
    }


    public static function statusName($status):string {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status):string {
        switch ($status){
            case User::STATUS_WAIT:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function designationValue($designation):string {
        switch ($designation){
            case User::LEARNER:
                $designationValue = 'Пользователь';
                break;
            case User::TEACHER:
                $designationValue = 'Школа';
                break;
        }
        return $designationValue;
    }


    public static function echoDate($date){
//        Yii::$app->formatter->locale = 'en-EN';
        return Yii::$app->formatter->asDatetime($date,'medium');
    }


    public static function isAccessAddCourse() :bool
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->designation != User::TEACHER){
            return false;
        }
        return true;
    }

    public static function isUserTeacher() :bool
    {
        if (Yii::$app->user->identity->designation == User::TEACHER){
            return true;
        }
        return false;
    }

    public static function getCabinetLink(){

        switch (Yii::$app->user->identity->designation){
            case User::LEARNER:
                return Url::to(['/cabinet/learner']);
                break;
            case User::TEACHER:
                return Url::to(['/cabinet/teacher']);
                break;

            default:
                return Url::to(['/']);
        }
    }


}