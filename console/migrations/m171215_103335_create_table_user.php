<?php

use yii\db\Migration;

class m171215_103335_create_table_user extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'soc' => $this->string(2),
            'sid' => $this->bigInteger(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'email' => $this->string(),
            'image' => $this->string(),
            'city' => $this->string(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
            'ip' => $this->string(),
            'browser' => $this->string(),
            'test_result_id' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%user}}', ['name', 'surname', 'image', 'city', 'created_at', 'updated_at'], [
            ['ivan', 'ivanov', '/img/user.jpg', 'Moscow', time(), time()],
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%user}}');
    }
}
