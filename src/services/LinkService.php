<?php

declare(strict_types=1);

namespace app\services;

use app\components\CustomUrl;
use app\entities\Link;
use app\forms\CreateLinkForm;
use app\groups\LinkListGroup;
use app\repositories\LinkRepository;
use chillerlan\QRCode\QRCode;
use yii\helpers\Url;
use DateTimeImmutable;
use Yii;

final class LinkService
{
    public function __construct(
        private readonly LinkRepository $linkRepository,
        private readonly QRCode $QRCode,
    ) {

    }

    public function listByStatistic(): array
    {
        $links = $this->linkRepository->findAllCountLinkLog();
        foreach ($links as $link) {
            $count = count($link->linkLogs ?? 0);
            $link->setCountLinkLog($count);
        }

        return LinkListGroup::toArray($links);
    }

    public function create(CreateLinkForm $form): array
    {
        $link = $this->linkRepository->findByLink((string) $form->link ?? '');
        if (empty($link)) {
            $link = new Link();
            $link->link = (string) $form->link ?? '';
            $link->link_generated = CustomUrl::toUrl(['/q-r/index', 'slug' => $this->generateLink()]);
            $link->created_at = (new DateTimeImmutable())->format('Y-m-d H:i:s');

            $this->linkRepository->save($link);
        }

        return [
            'message' => 'Успешно сгенерирован QR-код',
            'additional' => [
                'qr_code' => $this->generateQR($link->link),
                'link_generated' => $link->link_generated,
            ],
        ];
    }

    private function generateQR(string $link)
    {
        return $this->QRCode->render($link);
    }

    private function generateLink(): string
    {
        $generatedLink = Yii::$app->security->generateRandomString(8);
        if ($this->checkLink($generatedLink)) {
            $this->generateLink();
        }

        return $generatedLink;
    }

    private function checkLink(string $generatedLink): bool
    {
        return $this->linkRepository->existsByLinkGenerated($generatedLink);
    }
}
