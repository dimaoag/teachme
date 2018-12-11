<?php
namespace frontend\controllers\course;


use shop\helpers\CourseHelper;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use shop\forms\manage\shop\course\PhotosForm;
use shop\forms\manage\shop\course\GalleryForm;
use shop\entities\shop\course\Course;
use yii\helpers\VarDumper;
use yii\web\Controller;
use shop\forms\manage\shop\course\CourseCreateForm;
use shop\forms\manage\shop\course\CourseEditForm;
use shop\services\manage\CourseManageService;
use shop\helpers\UserHelper;
use yii\web\NotFoundHttpException;
use shop\services\manage\UserManegeService;
use shop\forms\course\search\SearchForm;
use shop\readModels\shop\CourseReadRepository;

class SearchController extends Controller{


    private $courseReadRepository;

    public function __construct($id, $module, CourseReadRepository $courseReadRepository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->courseReadRepository = $courseReadRepository;
    }



    public function actionSearch()
    {
        $form = new SearchForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->courseReadRepository->search($form);
        $maxPrice = $this->courseReadRepository->getMaxPrice();

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
            'maxPrice' => $maxPrice,
        ]);
    }



}