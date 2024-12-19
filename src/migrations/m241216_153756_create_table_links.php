<?php

use app\components\migration\Migration;

final class m241216_153756_create_table_links extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \app\entities\Link::tableName(),
            [
                'id' => $this->primaryKey(),
                'link' => $this->varchar(256)->unique(),
                'link_generated' => $this->varchar(256)->unique(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \app\entities\Link::tableName(),
        );
    }
}
