<?php

use yii\db\Migration;

class m171222_135435_create_table_challenge extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%challenge}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(255),
            'soc' => $this->integer(1),
            'likes' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->integer(1)->defaultValue(0),

            'platform' => $this->string(255),
            'access_key' => $this->string(255)->unique(),
            'image' => $this->string(255),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{challenge}_user_id_fkey", '{{%challenge}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%challenge}}');
    }
}