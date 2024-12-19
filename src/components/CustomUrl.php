<?php

namespace app\components;

use Yii;

final class CustomUrl
{
    public static function toUrl(array $url): string
    {
        $urlManager = Yii::$app->getUrlManager();

        return $urlManager->createAbsoluteUrl($url, true);
    }
}
