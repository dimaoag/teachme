<?php
namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use yii\base\Event;
use yii\web\View;
use shop\forms\auth\LoginForm;


class AppController extends Controller
{

    public function beforeAction($action)
    {
        Event::on(View::class, View::EVENT_BEFORE_RENDER, function() {

            $loginForm = new LoginForm();
            Yii::$app->view->params['loginForm'] = $loginForm;
        });
        return parent::beforeAction($action);
    }

}