<?php

use yii\db\Migration;

/**
 * Class m220617_082720_create_table_duolingo
 */
class m220617_082720_create_table_duolingo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('duolingo',
            [
                'id' => $this->primaryKey(),
                'word' => $this->text(),
                'count_words' => $this->integer(),
                'var1' => $this->text(),
                'var2' => $this->text(),
                'var3' => $this->text(),
                'var4' => $this->text(),
                'var5' => $this->text(),
                'var6' => $this->text(),
                'user_id' => $this->integer()
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('duolingo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_082720_create_table_duolingo cannot be reverted.\n";

        return false;
    }
    */
}
