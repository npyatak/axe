<?php

use yii\db\Migration;

class m171215_105335_create_table_question extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'number' => $this->integer()->notNull(),
            'comment' => $this->string(),
        ], $tableOptions);

        $this->batchInsert('{{%question}}', ['number', 'title'], [
            [1, 'Что для вас важнее?'],
            [2, 'Что будешь делать, если попалась команда настолько молодая и никому не известная, что не знает азбуку?'],
            [3, 'Вокруг вас мертвый город, полный нечистью и их предводителями. Твои действия?'],
            [4, 'Какая у вас любимая тактика?'],
            [5, 'Что делать, если вы окружены?'],
            [6, 'Ваша любимая позиция…'],
            [7, 'Что делать, если снайпер слишком сильный?'],
            [8, 'Выберите…'],
            [9, 'Определите свой уровень:'],
            [10, 'Насколько сильно Вы поддаетесь эмоциям?'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}