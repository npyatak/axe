<?php

use yii\db\Migration;

class m180122_142754_alter_tables extends Migration
{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('shooting_result', 're_captcha', $this->text());
        $this->addColumn('shooting_result', 're_captcha_response', $this->text());
        
        $this->addColumn('clickbattle_result', 're_captcha', $this->text());
        $this->addColumn('clickbattle_result', 're_captcha_response', $this->text());
    }

    public function safeDown() {
        $this->dropColumn('shooting_result', 're_captcha');
        $this->dropColumn('shooting_result', 're_captcha_response');

        $this->dropColumn('clickbattle_result', 're_captcha');
        $this->dropColumn('clickbattle_result', 're_captcha_response');
    }
}