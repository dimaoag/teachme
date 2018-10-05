<?php
namespace frontend\controllers;

use avator\turbosms\Turbosms;
use Yii;
use yii\web\Controller;


class SiteController extends Controller{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex(){
        $this->layout = 'home';
        return $this->render('index');
    }


    public function actionAbout(){
        return $this->render('about');
    }


}
