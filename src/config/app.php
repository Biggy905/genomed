<?php

$db = require 'db.php';
$routes = require 'routes.php';
$singletons = require 'singletons.php';
$params = require 'params.php';

$config = [
    'id' => 'app',
    'name' => 'Сайт',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site',
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => $db,
        'assetManager' => [
            'linkAssets' => false,
            'forceCopy' => true,
        ],
        'request' => [
            'class' => \yii\web\Request::class,
            'cookieValidationKey' => 'tnb245vDdVgZwHZ1f-geEj8yF4nQ4gR5',
        ],
        'errorHandler' => [
            'class' => \yii\web\ErrorHandler::class,
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => $singletons,
        'definitions' => [],
    ],
];

return $config;
