<?php

namespace backend\controllers\course;

use shop\forms\manage\shop\course\PriceModificationForm;
use shop\services\manage\PriceModificationManageService;
use Yii;
use shop\entities\shop\course\PriceModification;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PriceModificationController extends Controller
{
    private $service;

    public function __construct($id, $module, PriceModificationManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PriceModification::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'priceModification' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new PriceModificationForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $priceModification = $this->service->create($form);
                return $this->redirect(['view', 'id' => $priceModification->id]);
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
        $priceModification = $this->findModel($id);

        $form = new PriceModificationForm($priceModification);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($priceModification->id, $form);
                return $this->redirect(['view', 'id' => $priceModification->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'priceModification' => $priceModification,
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



    protected function findModel($id): PriceModification
    {
        if (($model = PriceModification::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
