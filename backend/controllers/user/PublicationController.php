<?php

namespace backend\controllers\user;


use backend\forms\UserSearch;
use shop\forms\manage\user\PublicationChangeForm;
use shop\services\manage\UserManegeService;
use shop\entities\user\User;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class PublicationController extends Controller
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


    public function actionChange($course_type_id, $user_id)
    {
        $user = $this->findModel($user_id);
        $publication = $user->getPublication($course_type_id);

        $publication ? $form = new PublicationChangeForm($publication) : $form = new PublicationChangeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->userManegeService->changePublication($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }
        return $this->render('change', [
            'model' => $form,
            'course_type_id' => $course_type_id,
            'user_id' => $user_id,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
