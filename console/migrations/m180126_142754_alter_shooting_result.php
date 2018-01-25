<?php

use yii\db\Migration;

class m180126_142754_alter_shooting_result extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('shooting_result', 'play_again', $this->integer(1));
        $this->addColumn('shooting_result', 'updated_at', $this->integer());
        $this->addColumn('shooting_result', 'browser', $this->string(255));
    }

    public function safeDown() {
        $this->dropColumn('shooting_result', 'play_again');
        $this->dropColumn('shooting_result', 'updated_at');
        $this->dropColumn('shooting_result', 'browser');
    }
}