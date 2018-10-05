<?php
namespace frontend\controllers\auth;

use frontend\components\Debug;
use shop\forms\auth\ConfirmPasswordForm;
use shop\forms\auth\SignupForm;
use shop\services\auth\SignupService;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use shop\repositories\UserRepository;
use avator\turbosms\Turbosms;

class SignupController extends Controller
{

    private $signupService;
    private $users;

    public function __construct(string $id, Module $module, SignupService $signupService, UserRepository $users,array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupService = $signupService;
        $this->users = $users;
    }

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->signupService->signup($form);
                Yii::$app->session->setFlash('success', 'Проверте код на телефоне');
                return $this->redirect('/auth/signup/confirm');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }


    public function actionConfirm(){
        $form = new ConfirmPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->signupService->confirm($form->confirm_code);
                Yii::$app->user->login($user, 3600);
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('confirm', [
            'model' => $form,
        ]);
    }


}