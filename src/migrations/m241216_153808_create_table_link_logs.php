<?php

use app\components\migration\Migration;

/**
 * Class m241216_153808_create_table_link_logs
 */
class m241216_153808_create_table_link_logs extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \app\entities\LinkLog::tableName(),
            [
                'id' => $this->primaryKey(),
                'id_link' => $this->integer(),
                'ip' => $this->char(14),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \app\entities\LinkLog::tableName(),
        );
    }
}
