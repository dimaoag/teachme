<?php
namespace shop\helpers;


use shop\repositories\shop\OrderRepository;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\course\Order;


class OrderHelper
{

    public static function echoDate($date){
//        Yii::$app->formatter->locale = 'en-EN';
        return Yii::$app->formatter->asDate($date,'medium');
    }


    public static function selectStatusList(){
        return [
            Order::STATUS_NEW => 'Новая заявка',
            Order::STATUS_PROCESSING => 'В обработке',
            Order::STATUS_COMPLETED => 'Завершонная'
        ];

    }

    public static function getStatusName($status):string {
        switch ($status){
            case Order::STATUS_NEW:
                $name = 'Новая заявка';
                break;
            case Order::STATUS_PROCESSING:
                $name = 'В обработке';
                break;
            case Order::STATUS_COMPLETED:
                $name = 'Завершонная';
                break;
            default:
                $name = '';
        }
        return $name;
    }



}