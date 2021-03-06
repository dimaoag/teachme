<?php
namespace shop\helpers;


use shop\repositories\shop\CourseRepository;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\course\Course;
use shop\entities\shop\course\PriceModification;



class CourseHelper
{
    public static function isUserCourse($courseId, $userId){
        $repository = new CourseRepository();
        $course = $repository->get($courseId);
        return $course->user_id = $userId ? true : false;
    }


    public static function getStatus(Course $course){

        switch ($course->status){
            case Course::STATUS_NOT_ACTIVE:
                $res = 'Неактивный';
                break;
            case Course::STATUS_ON_MODERATION:
                $res = 'На модерации';
                break;
            case Course::STATUS_ACTIVE:
                $dateStart = Yii::$app->formatter->asDate($course->date_start_sale, 'php:d/m/Y');
                $dateStop = Yii::$app->formatter->asDate($course->date_stop_sale, 'php:d/m/Y');
                $res = 'Активный '. $dateStart . ' - ' .$dateStop;
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
        $courseRepository = new CourseRepository();
        $course = $courseRepository->get($courseId);

        $isDisableClass = UserHelper::checkPublications(Yii::$app->user->id, $course->courseType->id) ? "" : 'disabled="disabled" style="pointer-events: none; opacity: 0.5;"';

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



    public static function echoDate($date){
//        Yii::$app->formatter->locale = 'en-EN';
        return Yii::$app->formatter->asDate($date,'medium');
    }



    public static function showPriceModification(PriceModification $priceModification, $price)
    {
        switch ($priceModification->id){
            case PriceModification::FROM:
                $res = '<p class="current-price">'. Html::encode($priceModification->title) .' '. Html::encode($price) .'  грн</p>';
                break;
            case PriceModification::TO:
                $res = '<p class="current-price">'. Html::encode($priceModification->title) .' '. Html::encode($price) .'  грн</p>';
                break;
            case PriceModification::IN_MONTH:
                $res = '<p class="current-price">'. Html::encode($price) .'  грн'. Html::encode($priceModification->title) .'</p>';
                break;
            case PriceModification::FREE:
                $res = '<p class="current-price">'. Html::encode($priceModification->title) .'</p>';
                break;
            case PriceModification::KNOW_PRICE:
                $res = '<p class="current-price">'. Html::encode($priceModification->title) .'</p>';
                break;
            default:
                $res = '<p class="current-price">'. Html::encode($price) .'  грн</p>';
        }
        return $res;
    }




}