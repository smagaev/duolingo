<?php

use yii\db\Migration;

/**
 * Class m220816_074952_create_table_irregular_verbs
 */
class m220816_074952_create_table_irregular_verbs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('verbs', [

            'id' => $this->primaryKey(),
            'form1' => $this->text(),
            'form2' => $this->text(),
            'form3' => $this->text(),
            'meaning' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('verbs');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220816_074952_create_table_irregular_verbs cannot be reverted.\n";

        return false;
    }
    */
}
