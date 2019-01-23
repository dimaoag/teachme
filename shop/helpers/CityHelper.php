<?php
namespace shop\helpers;


use yii\helpers\Html;
use shop\entities\shop\City;



class CityHelper
{
    public static function cityList(){

        $cities = City::find()->orderBy(['name' => SORT_ASC,])->all();

        $res = '<select name="city">'
                    .'<option value="">Город...</option>';

        foreach ($cities as $city){
            /** @var City $city */

            $res .= '<option value="'.$city->id.'">'. Html::encode($city->name) .'</option>';
        }
        $res .= '</select>';

        return $res;

    }





}