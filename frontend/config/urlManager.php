<?php
return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        '<_a:about>' => 'site/<_a>',
        'contact' => 'contact/contact/index',
        'signup' => 'auth/signup/index',
        'request' => 'auth/reset/request',
        'reset' => 'auth/reset/reset',
        'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
        '<_a:login|logout>' => 'auth/auth/<_a>',

        'course' => 'course/course/index',
        'course/<_a:[\w-]+>' => 'course/course/<_a>',


        'cabinet/learner' => 'cabinet/learner/default/index',
        'cabinet/teacher' => 'cabinet/teacher/default/index',
//        'cabinet/<_c:[\w\-]+>' => 'cabinet/<_c>/index',
//        'cabinet/<_c:[\w\-]+>/<id:\d+>' => 'cabinet/<_c>/view',
        'cabinet/learner/<_c:[\w\-]+>/<_a:[\w-]+>' => 'cabinet/learner/<_c>/<_a>',
        'cabinet/teacher/<_c:[\w\-]+>/<_a:[\w-]+>' => 'cabinet/teacher/<_c>/<_a>',
//        'cabinet/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
]; 