<?php

namespace frontend\controllers\cabinet;

use shop\readModels\course\CourseReadRepository;
use shop\services\user\WishlistService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use frontend\controllers\AppController;

class WishlistController extends AppController
{

    private $service;
    private $courses;

    public function __construct($id, $module, WishlistService $service, CourseReadRepository $courses, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;

        $this->courses = $courses;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->courses->getWishList(\Yii::$app->user->id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionAdd()
    {
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            try {
                $this->service->add(Yii::$app->user->id, $id);
//            Yii::$app->session->setFlash('success', 'Success!');
                return $this->asJson(['success' => true, 'heart' => true, 'url' => Url::to(['delete-ajax'], true)]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove(Yii::$app->user->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionDeleteAjax()
    {
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            try {
                $this->service->remove(Yii::$app->user->id, $id);
                return $this->asJson(['success' => true, 'heart' => false, 'url' => Url::to(['add'], true)]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}