<?php

use yii\db\Migration;

class m180124_142754_alter_clickbattle_result extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('clickbattle_result', 'targets_type', $this->integer(1));
    }

    public function safeDown() {
        $this->dropColumn('clickbattle_result', 'targets_type');
    }
}