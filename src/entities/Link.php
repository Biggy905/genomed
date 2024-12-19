<?php

declare(strict_types=1);

namespace app\entities;

use app\components\model\AbstractModel;
use app\queries\LinkQuery;

/**
 *
 * @property-read int $orderLinkLogs
 */
final class Link extends AbstractModel
{
    public int $countLinkLog = 0;

    protected static ?string $tableName = '{{%links}}';

    protected static ?string $nameClassQuery = LinkQuery::class;

    public function getLinkLogs(): \yii\db\ActiveQuery
    {
        return $this->hasMany(LinkLog::class, ['id_link' => 'id']);
    }

    public function setCountLinkLog(int $count): void
    {
        $this->countLinkLog = $count;
    }
}
