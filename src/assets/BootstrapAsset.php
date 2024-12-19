<?php

namespace app\assets;

use app\assets\JqueryAsset;
use yii\web\AssetBundle;

final class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@resourcesBootstrap';

    public $css = [
        'css/bootstrap.min.css',
    ];

    public $js = [
        'js/bootstrap.min.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
    public $jsOptions = [
        'appendTimestamp' => true
    ];

    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
