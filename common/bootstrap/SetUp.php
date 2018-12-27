<?php
namespace common\bootstrap;


use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;


//use shop\cart\storage\HybridStorage;

use shop\services\auth\PasswordResetService;
use shop\services\contact\ContactService;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\caching\Cache;
use yii\di\Container;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {

        $container = \Yii::$container;


        $container->setSingleton(MailerInterface::class, function () use ($app){
            return $app->mailer;
        });

        $container->setSingleton(PasswordResetService::class);
        //MailerInterface::class по дефолту автоматически передается как параметр

        $container->setSingleton(ContactService::class, [],[
            $app->params['adminEmail']
            //MailerInterface::class по дефолту автоматически передается как параметр
        ]);


        $container->setSingleton(Client::class, function () use ($app){
            return ClientBuilder::create()->build();
        });


        $container->setSingleton(ErrorHandler::class, function () use ($app) {
            return $app->errorHandler;
        });

        $container->setSingleton(Queue::class, function () use ($app) {
            return $app->get('queue');
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });


        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });



//        $container->setSingleton(Cart::class, function () use ($app) {
//            return new Cart(
//                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
//                new DynamicCost(new SimpleCost())
//            );
//        });


//        $container->setSingleton(SmsSender::class, function () use ($app) {
//            return new LoggedSender(
//                new SmsRu($app->params['smsRuKey']),
//                \Yii::getLogger()
//            );
//        });


    }
}