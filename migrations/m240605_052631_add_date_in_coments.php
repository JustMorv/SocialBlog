<?php

use yii\db\Migration;

/**
 * Class m240605_052631_add_date_in_coments
 */
class m240605_052631_add_date_in_coments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('comment', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'date');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240605_052631_add_date_in_coments cannot be reverted.\n";

        return false;
    }
    */
}
