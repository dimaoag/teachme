<?php
namespace frontend\controllers\cabinet\learner;


use shop\helpers\UserHelper;
use shop\repositories\UserRepository;
use shop\services\user\ProfileService;
use yii\base\Module;
use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller {


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
                            return (UserHelper::isUserTeacher()) ? true : false ;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete-firm-photo' => ['POST'],
                ],
            ],
        ];
    }



    public function actionIndex(){


        return $this->render('index');
    }

}