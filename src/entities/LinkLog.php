<?php

declare(strict_types=1);

namespace app\entities;

use app\components\model\AbstractModel;
use app\queries\LinkLogQuery;

final class LinkLog extends AbstractModel
{
    protected static ?string $tableName = '{{%link_logs}}';

    protected static ?string $nameClassQuery = LinkLogQuery::class;
}
