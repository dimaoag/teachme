<?php
namespace frontend\controllers\auth;

use shop\forms\auth\LoginForm;
use shop\services\auth\AuthService;
use yii\base\Module;
use yii\web\Controller;
use Yii;



class AuthController  extends Controller
{
    private $authService;

    public function __construct(string $id, Module $module, AuthService $authService,array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }


    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->authService->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? Yii::$app->params['rememberMeDuration'] : 0);
//                return $this->goBack();
                return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('login', [
            'model' => $form,
        ]);
    }



    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->request->referrer ?: $this->goHome());
    }

}