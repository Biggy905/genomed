<?php

declare(strict_types=1);

namespace app\components\query;

interface AbstractQueryInterface
{
    public function byId(int $id): AbstractQueryInterface;

    public function byDeletedNull(): AbstractQueryInterface;

    public function page(int $page, int $limit): AbstractQueryInterface;
}
