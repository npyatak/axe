<?php

use yii\db\Migration;

class m171226_115345_create_table_challenge_vote extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%challenge_vote}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'challenge_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{challenge_vote}_user_id_fkey", '{{%challenge_vote}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("{challenge_vote}_challenge_id_fkey", '{{%challenge_vote}}', 'challenge_id', '{{%challenge}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('{challenge_vote}_user_id_fkey', '{{%challenge_vote}}');
        $this->dropForeignKey('{challenge_vote}_challenge_id_fkey', '{{%challenge_vote}}');

        $this->dropTable('{{%challenge_vote}}');
    }
}