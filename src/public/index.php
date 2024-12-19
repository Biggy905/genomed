<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/bootstrap.php';

use yii\web\Application;
use Dotenv\Dotenv;

(Dotenv::createUnsafeImmutable(
    Yii::getAlias('@root'),
    ['.env'],
    false
))->load();

$config = require __DIR__ . '/../config/app.php';

(new Application($config))->run();
