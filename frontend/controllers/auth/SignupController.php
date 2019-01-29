<?php
namespace frontend\controllers\auth;

use frontend\components\Debug;
use shop\forms\auth\ConfirmPasswordForm;
use shop\forms\auth\SignupLearnerForm;
use shop\forms\auth\SignupTeacherForm;
use shop\services\auth\SignupService;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use shop\repositories\UserRepository;
use avator\turbosms\Turbosms;
use frontend\controllers\AppController;

class SignupController extends AppController
{

    private $signupService;
    private $users;

    public function __construct(string $id, Module $module, SignupService $signupService, UserRepository $users,array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupService = $signupService;
        $this->users = $users;
    }



    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
            $this->redirect('/course/search/search');
        }

        $learnerForm = new SignupLearnerForm();
        $teacherForm = new SignupTeacherForm();

        if ($learnerForm->load(Yii::$app->request->post()) && $learnerForm->validate()) {
            try {
                $this->signupService->signupLearner($learnerForm);
                Yii::$app->session->setFlash('success', 'Проверте код на телефоне');
                return $this->redirect('/auth/signup/confirm');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        if ($teacherForm->load(Yii::$app->request->post()) && $teacherForm->validate()) {
            try {
                $this->signupService->signupTeacher($teacherForm);
                Yii::$app->session->setFlash('success', 'Проверте код на телефоне');
                return $this->redirect('/auth/signup/confirm');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'modelLearner' => $learnerForm,
            'modelTeacher' => $teacherForm,
        ]);
    }


    public function actionConfirm(){
        $form = new ConfirmPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->signupService->confirm($form->confirm_code);
                Yii::$app->user->login($user, Yii::$app->params['rememberMeDuration']);
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