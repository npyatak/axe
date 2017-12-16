<?php

use yii\db\Migration;

class m171215_115435_create_table_result extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%result}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'text' => $this->string(255)->notNull(),
            'share_text' => $this->string(255),
            'share_image' => $this->string(255),

        ], $tableOptions);

        $this->batchInsert('{{%result}}', ['title', 'text', 'share_text'], [
            ['Вы – истребитель танков, командир самоходной артиллерийской установки', 'Неплохо. Вы могли бы стать превосходным игроком WoT, играя на ПТ-САУ. Пассивный стиль игры – Ваше всё, так как немногим дано столько терпения, сколько есть у Вас.', 'текст поделиться'],
            ['Вы – универсальный солдат', 'Хм… Нам кажется, что Вы можете играть абсолютно во всё и всюду показывать чудеса скилла. Вас тяжело вывести из себя, но, когда это происходит, лучше бежать.', 'текст поделиться'],
            ['Вы – командир отряда Rainbow Six', 'Любой фанат игр с первого взгляда заподозрит в Вас эксперта в шутерах и любых играх, связанных с реакций, способностью быстро принимать решения. Однако вы часто поддаетесь эмоциям.', 'текст поделиться'],
            ['Вы – Джим Рейнор, старший офицер Конфедерации на Мар Саре', 'Когда Вы входите в сеть, все Ваши друзья засыпают личные сообщения приглашениями присоединиться. Вы востребованы в любой игре, которая требует удержания в голове большого количества информации. Например, в StarCraft 2.', 'текст поделиться'],
            ['Вы – Топ-1 легенды Hearthstone', 'При виде Вас противники сразу сдаются, а друзья целуют руку, как дону Карлеоне, ведь Вы – топ 1 легенды Hearthstone!', 'текст поделиться'],
            ['Вы – доминатор миров MMOGPG', 'ММО РПГ может стать вашей стихией. Мидл задрожит под напором вашей ульты.', ''],
            ['Вы – чемпион Рунтерры', 'Вы случайно не игрок LOL? Нет? Тогда откуда у Вас столько навыков ведения боя?', 'текст поделиться'],
            ['Вы – герой вселенной Dota 2', 'Dota 2 явно Ваш конёк. Тут не надо лишних слов.', 'текст поделиться'],
            ['Заголовок', 'К сожалению, мы не можем определить специфику Вашего склада ума и предположить во что Вы играете.', 'текст поделиться'],
            ['Вы – новичок в киберспорте', 'В киберспорте, к сожалению, Вы пока никто, но у Вас все ещё впереди.', 'текст поделиться']
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%result}}');
    }
}