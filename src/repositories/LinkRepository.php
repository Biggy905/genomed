<?php

declare(strict_types=1);

namespace app\repositories;

use app\entities\Link;
use app\entities\LinkLog;
use app\queries\LinkLogQuery;
use app\repositories\interfaces\LinkRepositoryInterface;
use LogicException;

final class LinkRepository implements LinkRepositoryInterface
{
    public function findById(int $id): ?Link
    {
        return Link::find()->byId($id)->one();
    }

    public function findAll(): array
    {
        return Link::find()->all();
    }

    public function findByLink(string $link): ?Link
    {
        return Link::find()
            ->byLink($link)
            ->one();
    }

    public function existsByLink(string $link): bool
    {
        return Link::find()
            ->byLink($link)
            ->exists();
    }

    public function findByLinkGenerated(string $generatedLink): ?Link
    {
        return Link::find()
            ->byLinkGenerated($generatedLink)
            ->one();
    }

    public function existsByLinkGenerated(string $generatedLink): bool
    {
        return Link::find()
            ->byLinkGenerated($generatedLink)
            ->exists();
    }

    public function findAllCountLinkLog()
    {
        return Link::find()
            ->joinWith('linkLogs')
            ->all();
    }

    public function save(Link $link): void
    {
        $link->save();
    }
}
