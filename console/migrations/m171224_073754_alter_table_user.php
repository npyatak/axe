<?php

use yii\db\Migration;

/**
 * Class m171224_073754_alter_table_user
 */
class m171224_073754_alter_table_user extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('user', 'rules_test', $this->integer(1)->defaultValue(0));
        $this->addColumn('user', 'rules_challenge', $this->integer(1)->defaultValue(0));
        $this->addColumn('user', 'rules_clickbattle', $this->integer(1)->defaultValue(0));
        $this->addColumn('user', 'rules_shooting', $this->integer(1)->defaultValue(0));
        $this->addColumn('user', 'access_token', $this->string());
    }

    public function safeDown() {
        $this->dropColumn('user', 'rules_test');
        $this->dropColumn('user', 'rules_challenge');
        $this->dropColumn('user', 'rules_clickbattle');
        $this->dropColumn('user', 'rules_shooting');
        $this->dropColumn('user', 'access_token');
    }
}
