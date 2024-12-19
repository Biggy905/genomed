<?php

$appDir = dirname(__DIR__, 3);
Yii::setAlias('root', $appDir);

Yii::setAlias('app', $appDir);
Yii::setAlias('Tests', $appDir . '/tests');
Yii::setAlias('vendor', $appDir . '/vendor');
Yii::setAlias('console', $appDir);
Yii::setAlias('resourcesJquery', $appDir . '/resources/jquery');
Yii::setAlias('resourcesBootstrap', $appDir . '/resources/bootstrap');
Yii::setAlias('resourcesToastr', $appDir . '/resources/toastr');
