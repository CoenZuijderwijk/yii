<?php

use yii\db\Migration;

/**
 * Class m200303_082209_add_category_to_news
 */
class m200303_082209_add_category_to_news extends Migration
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
        echo "m200303_082209_add_category_to_news cannot be reverted.\n";

        return false;
    }

    public function up() {
        $this->addColumn('news', 'category', $this->integer());
    }

    public function down() {
        $this->dropColumn('news', 'category');
    }

}
