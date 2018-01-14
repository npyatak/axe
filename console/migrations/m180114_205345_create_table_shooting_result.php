<?php

use yii\db\Migration;

class m180114_205345_create_table_shooting_result extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shooting_result}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'score' => $this->integer()->notNull()->defaultValue(0),
            'client_score' => $this->integer(),
            'ip' => $this->string(),

            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{shooting_result}_user_id_fkey", '{{%shooting_result}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('{shooting_result}_user_id_fkey', '{{%shooting_result}}');

        $this->dropTable('{{%shooting_result}}');
    }
}