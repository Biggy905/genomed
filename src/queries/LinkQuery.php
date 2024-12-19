<?php

declare(strict_types=1);

namespace app\queries;

use app\components\query\AbstractQuery;
use app\entities\Link;
use app\entities\LinkLog;

final class LinkQuery extends AbstractQuery
{
    public function byLink(string $link): self
    {
        return $this->andWhere(
            [
                Link::tableName() . '.link' => $link
            ]
        );
    }

    public function byLinkGenerated(string $generatedLink): self
    {
        return $this->andWhere(
            [
                Link::tableName() . '.link_generated' => $generatedLink
            ]
        );
    }
}
