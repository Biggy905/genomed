<?php

namespace app\assets;

use app\assets\JqueryAsset;
use yii\web\AssetBundle;

final class ToastrAsset extends AssetBundle
{
    public $sourcePath = '@resourcesToastr';

    public $css = [
        'css/toastr.min.css',
    ];

    public $js = [
        'js/toastr.min.js',
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
    ];
    public $jsOptions = [
        'appendTimestamp' => true
    ];

    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
