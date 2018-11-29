<?php
namespace shop\debug;


class Debug
{
    public static function show($array, $die = true){
        if ($die){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
            die();
        } else {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    }
}