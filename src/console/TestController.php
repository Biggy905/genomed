<?php

namespace app\console;

use yii\console\Controller;
use Yii;

final class TestController extends Controller
{
    public function actionTest(): void
    {
        echo "Hello world!";
        //var_dump(Yii::$app);
    }
}
