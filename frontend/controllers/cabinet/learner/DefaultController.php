<?php
namespace frontend\controllers\cabinet\learner;


use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller {


//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ]
//                ],
//            ],
//        ];
//    }


    public function actionIndex(){


        return $this->render('index');
    }

}