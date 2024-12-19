<?php

$appDir = dirname(__DIR__, 2);
Yii::setAlias('root', $appDir);

$srcDir = dirname(__DIR__);
Yii::setAlias('vendor', $srcDir . '/vendor');
Yii::setAlias('console', $srcDir);
Yii::setAlias('resourcesJquery', $srcDir . '/resources/jquery');
Yii::setAlias('resourcesBootstrap', $srcDir . '/resources/bootstrap');
Yii::setAlias('resourcesToastr', $srcDir . '/resources/toastr');
