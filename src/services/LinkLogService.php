<?php

declare(strict_types=1);

namespace app\services;

use app\components\CustomUrl;
use app\entities\LinkLog;
use app\forms\SlugForm;
use app\repositories\LinkLogRepository;
use app\repositories\LinkRepository;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use DateTimeImmutable;
use Yii;

final class LinkLogService
{
    public function __construct(
        private readonly LinkLogRepository $linkLogRepository,
        private readonly LinkRepository $linkRepository,
    ) {

    }

    public function read(SlugForm $form): string
    {
        $url = CustomUrl::toUrl(['q-r/index', 'slug' => $form->slug]);
        $link = $this->linkRepository->findByLinkGenerated($url);
        if (!$link) {
            throw new NotFoundHttpException('Не найдена ссылка');
        }

        $linkLog = new LinkLog();
        $linkLog->id_link = $link->id;
        $linkLog->ip = Yii::$app->getRequest()->getUserIP();
        $linkLog->created_at = (new DateTimeImmutable())->format('Y-m-d H:i:s');

        $this->linkLogRepository->save($linkLog);

        return $link->link;
    }
}
