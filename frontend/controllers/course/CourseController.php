<?php
namespace frontend\controllers\course;

use yii\web\Controller;

class CourseController extends Controller{


    public function actionIndex(){
        return $this->render('index');
    }

}