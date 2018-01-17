<?php

use yii\db\Migration;

class m180117_142754_alter_table_user extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('user', 'clickbattle_ban', $this->integer(1));
    }

    public function safeDown() {
        $this->dropColumn('user', 'clickbattle_ban');
    }
}