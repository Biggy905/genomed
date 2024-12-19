<?php

namespace app\components\migration;

use yii\db\SchemaBuilderTrait;

class Migration extends \yii\db\Migration
{
    use SchemaBuilderTrait;
    use CustomSchemaBuilderTrait;
}
