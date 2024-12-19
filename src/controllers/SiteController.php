<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\AbstractController;
use app\forms\CreateLinkForm;
use app\services\LinkService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

final class SiteController extends AbstractController
{
    public $defaultAction = 'index';

    public function __construct(
        $id,
        $module,
        private readonly LinkService $service,
        private readonly CreateLinkForm $createLinkForm,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionCreate(): Response
    {
        $this->response->format = Response::FORMAT_JSON;

        $post = json_decode(Yii::$app->request->getRawBody(), true) ?? [];
        $form = $this->createLinkForm;

        $data = match ($form->runValidate($post)) {
            true => $this->service->create($form),
            false => throw new BadRequestHttpException($form->getFirstError('link')),
        };

        return $this->response($data);
    }

    public function actionError(): string
    {
        return $this->render('error');
    }

    public function beforeAction($action)
    {
        if (
            ($this->action->id == 'create')
        ) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}
