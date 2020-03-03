<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m200303_081533_add_news_table
 */
class m200303_081533_add_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200303_081533_add_news_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("news", [
            "id" => Schema::TYPE_PK,
            "title" => Schema::TYPE_STRING,
            "content" => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
  $this->dropTable('news');
    }

}
