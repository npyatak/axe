<?php

use yii\db\Migration;

class m180116_142754_alter_table_clickbattle_result extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('clickbattle_result', 'targets', $this->text());
        $this->addColumn('clickbattle_result', 'clicks', $this->text());
    }

    public function safeDown() {
        $this->dropColumn('clickbattle_result', 'targets');
        $this->dropColumn('clickbattle_result', 'clicks');
    }
}