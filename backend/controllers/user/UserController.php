<?php

namespace backend\controllers\user;

use shop\forms\manage\user\UserEditForm;
use shop\services\manage\UserManegeService;
use Yii;
use shop\entities\user\User;
use backend\forms\UserSearch;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use shop\forms\manage\user\UserCreateForm;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    private $userManegeService;

    public function __construct(string $id, Module $module, UserManegeService $userManegeService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userManegeService = $userManegeService;
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $form = new UserCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $user = $this->userManegeService->create($form);
                $this->userManegeService->setPublicationToUser($user->id, 5);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }






    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $form = new UserEditForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->userManegeService->edit($id, $form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'user' => $user,
        ]);
    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
