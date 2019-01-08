<?php
namespace frontend\controllers\course;


use shop\forms\auth\LoginForm;
use yii\web\Controller;
use shop\forms\course\search\SearchForm;
use shop\readModels\course\CourseReadRepository;
use frontend\controllers\AppController;

class SearchController extends AppController{


    private $courseReadRepository;

    public function __construct($id, $module, CourseReadRepository $courseReadRepository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->courseReadRepository = $courseReadRepository;
    }



    public function actionSearch()
    {
        $form = new SearchForm();
        $loginForm = new LoginForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->courseReadRepository->search($form);
        $maxPrice = $this->courseReadRepository->getMaxPrice();

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
            'maxPrice' => $maxPrice,
            'loginForm' => $loginForm,
        ]);
    }



}