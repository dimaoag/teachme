<?php
namespace frontend\controllers\cabinet\learner;


use shop\forms\manage\user\ProfileEditForm;
use shop\forms\manage\user\ProfileEditPasswordForm;
use shop\helpers\UserHelper;
use shop\repositories\UserRepository;
use shop\services\user\ProfileService;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use frontend\controllers\AppController;

class DefaultController extends AppController {


    private $users;
    private $profileService;

    public function __construct(string $id, Module $module,
        UserRepository $users,
        ProfileService $profileService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->users = $users;
        $this->profileService = $profileService;
    }


    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return (UserHelper::isUserLearner()) ? true : false ;
                        },
                    ],
                ],
            ],
        ];
    }



    public function actionIndex(){

        $user = $this->users->getUserById(Yii::$app->user->id);


        $profileEditForm = new ProfileEditForm($user);
        if ($profileEditForm->load(Yii::$app->request->post())) {
            if ($profileEditForm->validate()){
                try {
                    $this->profileService->edit($user->id, $profileEditForm);
                    Yii::$app->session->setFlash('success', 'Данные успешно изменены');
                    return $this->redirect(Yii::$app->request->referrer ?: ['index']);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка. Данные не изменены');
            }
        }


        $profileEditPasswordForm = new ProfileEditPasswordForm($user);
        if ($profileEditPasswordForm->load(Yii::$app->request->post()) && $profileEditPasswordForm->validate()) {
            try {
                $this->profileService->changePassword($user->id, $profileEditPasswordForm);
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                return $this->redirect(Yii::$app->request->referrer ?: ['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'profileEditForm' => $profileEditForm,
            'profileEditPasswordForm' => $profileEditPasswordForm,
        ]);
    }

}