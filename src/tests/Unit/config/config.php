<?php

$db = require __DIR__ . '/../../../config/db.php';
$singletons = require __DIR__ . '/../../../config/singletons.php';
$params = require __DIR__ . '/../../../config/params.php';
$routes = require __DIR__ . '/../../../config/routes.php';

return [
    'id' => 'unit_test',
    'basePath' => dirname(__DIR__, 2),
    'controllerNamespace' => 'app\controllers',
//    'controllerMap' => [
//        'app\controllers',
//    ],
//    'controller' => app\controllers\QRController::class,
    'language' => 'ru',
    'bootstrap' => [],
    'components' => [
        'db' => $db,
        'assetManager' => [
            'bundles' => [
                \app\assets\BootstrapAsset::class => false,
                \app\assets\JqueryAsset::class => false,
                \app\assets\ToastrAsset::class => false,
            ],
        ],
        'request' => [
            'class' => \yii\web\Request::class,
            'cookieValidationKey' => 'tnb245vDdVgZwHZ1f-geEj8yF4nQ4gR5',
            'url' => '/',
        ],
        'errorHandler' => [
            'class' => \yii\web\ErrorHandler::class,
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'hostInfo' => 'http://localhost:3000',
            'rules' => $routes,
        ],
    ],
    'container' => [
        'singletons' => $singletons,
        'definitions' => [],
    ],
    'params' => $params,
];
