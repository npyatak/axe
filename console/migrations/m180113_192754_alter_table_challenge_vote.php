<?php

use yii\db\Migration;

class m180113_192754_alter_table_challenge_vote extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('challenge_vote', 'ip', $this->string(255));
        $this->addColumn('challenge_vote', 'browser', $this->string(255));
    }

    public function safeDown() {
        $this->dropColumn('challenge_vote', 'ip');
        $this->dropColumn('challenge_vote', 'browser');
    }
}