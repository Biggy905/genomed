<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

\Codeception\Util\Autoload::addNamespace('app', dirname(__DIR__));

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(
    dirname( __DIR__, 2),
    ['.env', '.env.local'],
    false
);
$dotenv->load();

$env = getenv('ENV');

defined('YII_ENV') or define('YII_ENV', $env);
defined('YII_DEBUG') or define('YII_DEBUG', 'production' !== $env);
