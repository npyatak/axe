<?php

use yii\db\Migration;

class m171228_115345_create_table_clickbattle_result extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%clickbattle_result}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'score' => $this->integer()->notNull()->defaultValue(0),
            'client_score' => $this->integer(),
            'ip' => $this->string(),

            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{clickbattle_result}_user_id_fkey", '{{%clickbattle_result}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('{clickbattle_result}_user_id_fkey', '{{%clickbattle_result}}');

        $this->dropTable('{{%clickbattle_result}}');
    }
}