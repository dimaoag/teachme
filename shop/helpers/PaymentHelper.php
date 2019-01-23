<?php
namespace shop\helpers;


use shop\entities\user\Payment;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PaymentHelper
{
    public static function statusList(): array {
        return [
            Payment::NEW => 'Новый',
            Payment::COMPLETED => 'Оплачен',
            Payment::CANCELLED => 'Отмененный',
        ];
    }


    public static function echoDate($date){
//        Yii::$app->formatter->locale = 'en-EN';
        return Yii::$app->formatter->asDatetime($date,'medium');
    }

    public static function statusLabel($status):string {
        switch ($status){
            case Payment::NEW:
                $class = 'label label-default';
                break;
            case Payment::COMPLETED:
                $class = 'label label-success';
                break;
            case Payment::CANCELLED:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }


}