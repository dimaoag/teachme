<?php
namespace frontend\controllers\course;

use yii\helpers\VarDumper;
use yii\web\Controller;

class CourseController extends Controller{


    public function actionIndex(){
        return $this->render('index');
    }


    public function actionCreate(){

        return $this->render('create');
    }

}