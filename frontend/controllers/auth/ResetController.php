<?php
namespace frontend\controllers\auth;

use shop\forms\auth\ConfirmPasswordForm;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\services\auth\PasswordResetService;
use yii\base\Module;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class ResetController extends Controller
{
    private $passwordResetService;

    public function __construct(string $id, Module $module, PasswordResetService $passwordResetService,array $config = []){
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
    }



    public function actionRequest(){
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->request($form);
                Yii::$app->session->setFlash('success', 'Проверте ваш телефон и введите код с смс');
                return $this->redirect('auth/reset/reset');
            } catch (\RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('request', [
            'model' => $form,
        ]);
    }


    public function actionReset(){
        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->validateCode($form->code);
                $this->passwordResetService->reset($form->code, $form);
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                return $this->redirect('/login');
            } catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('reset', [
            'model' => $form,
        ]);
    }




}