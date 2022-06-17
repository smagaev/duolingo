<?php

use yii\db\Migration;

/**
 * Class m220617_082803_create_table_timers
 */
class m220617_082803_create_table_timers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('options',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(8),
                'timer0' => $this->integer(4),
                'timer1' => $this->integer(4),
                'timer2' => $this->integer(4),
                'timer3' => $this->integer(4),
                'timer4' => $this->integer(4),
                'timer5' => $this->integer(4),
                'timer6' => $this->integer(4),
                'sourceWords' => $this->integer(1)
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('options');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_082803_create_table_timers cannot be reverted.\n";

        return false;
    }
    */
}
