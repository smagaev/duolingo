<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%duolingo}}`.
 */
class m220607_121436_add_user_column_to_duolingo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this-> addColumn('duolingo', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('duolingo', 'user_id');
    }
}
