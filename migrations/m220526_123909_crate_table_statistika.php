<?php

use yii\db\Migration;

/**
 * Class m220526_123909_crate_table_statistika
 */
class m220526_123909_crate_table_statistika extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        {
            $this->createTable('statistika', [

                'id' => $this->primaryKey(),
                'user_id' => $this->integer(8),
                'data' => $this->date(),
                'quantity' => $this->integer(2)
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('statistika');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220526_123909_crate_table_statistika cannot be reverted.\n";

        return false;
    }
    */
}
