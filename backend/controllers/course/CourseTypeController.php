<?php

namespace backend\controllers\course;

use shop\forms\manage\shop\CourseTypeForm;
use shop\services\manage\CourseTypeManageService;
use shop\entities\shop\CourseType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CourseTypeController extends Controller
{
    private $service;

    public function __construct($id, $module, CourseTypeManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
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

        $dataProvider = new ActiveDataProvider([
            'query' => CourseType::find(),
            'sort' => [
                'defaultOrder' => ['sort' => SORT_ASC]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'courseType' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CourseTypeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $courseType = $this->service->create($form);
                return $this->redirect(['view', 'id' => $courseType->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }


    public function actionUpdate($id)
    {
        $courseType = $this->findModel($id);

        $form = new CourseTypeForm($courseType);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($courseType->id, $form);
                return $this->redirect(['view', 'id' => $courseType->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'courseType' => $courseType,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return CourseType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): CourseType
    {
        if (($model = CourseType::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
