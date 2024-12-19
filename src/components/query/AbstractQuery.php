<?php

declare(strict_types=1);

namespace app\components\query;

use yii\db\ActiveQuery;

abstract class AbstractQuery extends ActiveQuery implements AbstractQueryInterface
{
    public function byId(int $id): AbstractQueryInterface
    {
        return $this->andWhere(
            [
                $this->modelClass::tableName() . '.id' => $id,
            ]
        );
    }

    public function byDeletedNull(): AbstractQueryInterface
    {
        return $this->andWhere(
            [
                $this->modelClass::tableName() . '.deleted_at' => null,
            ]
        );
    }

    public function page(int $page, int $limit): AbstractQueryInterface
    {
        if ($page < 1){
            $page = 1;
        }

        return $this
            ->limit($limit)
            ->offset($page * $limit - $limit);
    }
}
