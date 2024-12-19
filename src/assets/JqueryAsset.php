<?php

namespace app\assets;

use yii\web\AssetBundle;

final class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@resourcesJquery';

    public $js = [
        'jquery-3.7.1.min.js',
    ];
}
