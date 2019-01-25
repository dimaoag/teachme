<?php
namespace frontend\controllers;



use shop\entities\shop\Category;
use shop\forms\course\search\SearchForm;
use shop\readModels\course\CategoryReadRepository;
use shop\repositories\shop\CategoryRepository;
use yii\helpers\VarDumper;

class SiteController extends AppController {

    private $categories;

    public function __construct($id, $module,
        CategoryReadRepository $categories,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categories = $categories;
    }

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
        $form = new SearchForm();
        $categoryViews = $this->categories->getTreeWithSubsOf();

        return $this->render('index',[
            'categoryViews' => $categoryViews,
            'model' => $form
        ]);
    }


    public function actionAbout(){
        return $this->render('about');
    }


}
