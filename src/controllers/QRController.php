<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\AbstractController;
use app\components\CustomUrl;
use app\forms\SlugForm;
use app\services\LinkLogService;
use app\services\LinkService;
use yii\helpers\Url;
use yii\web\Response;

final class QRController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly LinkService $linkService,
        private readonly LinkLogService $linkLogService,
        private readonly SlugForm $slugForm,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(string $slug): Response
    {
        $form = $this->slugForm;
        $defaultRoute = match ($form->runValidate(['slug' => $slug])) {
            true => $this->linkLogService->read($form),
            default => CustomUrl::toUrl(['site/index']),
        };

        return $this->redirect($defaultRoute);
    }

    public function actionStatistic(): string
    {
        $links = $this->linkService->listByStatistic();

        return $this->render('statistic', ['links' => $links]);
    }
}
