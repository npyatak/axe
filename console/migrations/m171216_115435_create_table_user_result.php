<?php

use yii\db\Migration;

class m171216_115435_create_table_user_result extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_result}}', [
            'id' => $this->primaryKey(),
            'answers' => $this->text()->notNull(),
            'hash' => $this->string(255),
            'score' => $this->string(),
            'result_id' => $this->integer(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{user_result}_result_id_fkey", '{{%user_result}}', 'result_id', '{{%result}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_result}}');
    }
}