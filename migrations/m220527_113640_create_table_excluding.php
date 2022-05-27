<?php

use yii\db\Migration;

/**
 * Class m220527_113640_create_table_excluding
 */
class m220527_113640_create_table_excluding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        {
            $this->createTable('exclude', [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(8),
                'word_id' => $this->integer(),
                'time' => $this->integer(11)
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('exclude');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220527_113640_create_table_excluding cannot be reverted.\n";

        return false;
    }
    */
}
