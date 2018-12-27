<?php

namespace console\controllers;

use shop\entities\user\User;
use shop\services\manage\UserManegeService;
use Yii;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;

/**
 * Interactive console roles manager
 */
class RoleController extends Controller
{
    private $service;

    public function __construct($id, $module, UserManegeService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Adds role to user
     */
    public function actionAssign(): void
    {
        $phone = $this->prompt('Phone:', ['required' => true]);
        $user = $this->findModel($phone);
        $role = $this->select('Role:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'));
        $this->service->assignRole($user->id, $role);
        $this->stdout('Done!' . PHP_EOL);
    }

    private function findModel($phone): User
    {
        if (!$model = User::findOne(['phone' => $phone])) {
            throw new Exception('User is not found');
        }
        return $model;
    }
}