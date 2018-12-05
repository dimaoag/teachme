<?php
namespace frontend\controllers\cabinet\teacher;


use frontend\forms\UserSearch;
use shop\entities\shop\course\Course;
use shop\entities\user\User;
use shop\helpers\UserHelper;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\AccessControl;
use shop\repositories\UserRepository;
use shop\repositories\shop\CourseRepository;

class DefaultController extends Controller {

    private $users;
    private $courses;

    public function __construct(string $id, Module $module, UserRepository $users, CourseRepository $courses,array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->users = $users;
        $this->courses = $courses;
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
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'delete' => ['POST'],
//                    'delete-photo' => ['POST'],
//                    'delete-gallery-item' => ['POST'],
//                ],
//            ],
        ];
    }



    public function actionIndex(){

        $publications = User::find()
            ->select('publications')
            ->where(['id' => Yii::$app->user->id])
            ->one();
        $publications = ArrayHelper::getValue($publications,'publications');

        $courses = $this->courses->getCoursesByUserId(Yii::$app->user->id);




        return $this->render('index', [
            'publications' => $publications,
            'courses' => $courses,
        ]);
    }

}