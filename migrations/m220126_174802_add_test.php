<?php

use yii\db\Migration;

/**
 * Class m220126_174802_add_test
 */
class m220126_174802_add_test extends Migration
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
        echo "m220126_174802_add_test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220126_174802_add_test cannot be reverted.\n";

        return false;
    }
    */
}
