<?php

namespace backend\controllers\user;


use backend\forms\PaymentSearch;
use backend\forms\UserSearch;
use shop\forms\manage\user\PublicationChangeForm;
use shop\entities\user\User;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use shop\services\manage\PaymentManageService;


class PaymentController extends Controller
{
    private $paymentManageService;

    public function __construct(string $id, Module $module, PaymentManageService $paymentManageService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->paymentManageService = $paymentManageService;
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }




    public function actionIndex()
    {

        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDelete($id)
    {
        try {
            $this->paymentManageService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
