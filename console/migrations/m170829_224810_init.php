<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m170829_224810_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news}}',
            [
                'id' => Schema::TYPE_PK,
                'theme_id' => Schema::TYPE_INTEGER,
                'name' => Schema::TYPE_STRING,
                'text' => Schema::TYPE_TEXT,
                'date' => Schema::TYPE_DATE,
            ]);
        $this->createTable('{{%theme}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING,
            ]);
        $this->addForeignKey('news_to_themes', 'news', 'theme_id','theme','id');

    }

    public function safeDown()
    {
        $this->dropTable('{{%news}}');
        $this->dropTable('{{%theme}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170829_224810_init cannot be reverted.\n";

        return false;
    }
    */
}
