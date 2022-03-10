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
        $this->createTable('duolingo_user', [

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
        $this->dropTable('duolingo_user');

        return true;
    }

}
