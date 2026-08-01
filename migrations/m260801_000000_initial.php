<?php

use humhub\components\Migration;

class m260801_000000_initial extends Migration
{
    public function up()
    {
        $this->createTable('working_status_type', [
            'id' => 'pk',
            'name' => 'varchar(100) NOT NULL',
            'color' => 'varchar(7) NOT NULL DEFAULT \'#6c757d\'',
            'sort_order' => 'int(11) NOT NULL DEFAULT 0',
            'is_deleted' => 'tinyint(4) NOT NULL DEFAULT 0',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
        ], '');

        $this->createTable('working_status_user', [
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'type_id' => 'int(11) NOT NULL',
            'custom_text' => 'varchar(255) NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
        ], '');

        $this->createIndex('idx_working_status_user_unique', 'working_status_user', 'user_id', true);

        // Seed initial status types
        $now = date('Y-m-d H:i:s');
        $this->batchInsert('working_status_type', ['name', 'color', 'sort_order', 'is_deleted', 'created_at', 'updated_at'], [
            ['Free',  '#28a745', 10, 0, $now, $now],
            ['Busy',  '#dc3545', 20, 0, $now, $now],
            ['Away',  '#ffc107', 30, 0, $now, $now],
        ]);
    }

    public function down()
    {
        $this->dropTable('working_status_user');
        $this->dropTable('working_status_type');
    }
}