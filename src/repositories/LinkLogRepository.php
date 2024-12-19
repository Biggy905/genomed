<?php

declare(strict_types=1);

namespace app\repositories;

use app\entities\LinkLog;
use app\repositories\interfaces\LinkLogRepositoryInterface;
use LogicException;
use yii\db\Exception;

final class LinkLogRepository implements LinkLogRepositoryInterface
{
    public function save(LinkLog $linkLog): void
    {
        $linkLog->save();
    }
}
