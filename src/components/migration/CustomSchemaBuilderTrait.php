<?php

namespace app\components\migration;

use app\components\migration\Schema;

trait CustomSchemaBuilderTrait
{
    public function varchar($length = null): \yii\db\ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder(Schema::TYPE_VARCHAR, $length);
    }
}
