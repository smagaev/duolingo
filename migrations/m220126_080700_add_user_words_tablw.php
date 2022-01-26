<?php

use yii\db\Migration;

/**
 * Class m220126_080700_add_user_words_tablw
 */
class m220126_080700_add_user_words_tablw extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('duolingo_', [

            'id' => $this->primaryKey(),
            'words' => $this->string(),
            'transl' => $this->text(),
            'count_words' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('duolingo_');
        echo "m220126_080700_add_user_words_tablw reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220126_080700_add_user_words_tablw cannot be reverted.\n";

        return false;
    }
    */
}
