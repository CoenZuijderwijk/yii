<?php

use yii\db\Migration;

/**
 * Class m200302_144519_test_table
 */
class m200302_144519_test_table extends Migration
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
        echo "m200302_144519_test_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200302_144519_test_table cannot be reverted.\n";

        return false;
    }
    */
}
