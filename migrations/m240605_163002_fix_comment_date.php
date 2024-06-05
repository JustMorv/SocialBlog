<?php

use yii\db\Migration;

/**
 * Class m240605_163002_fix_comment_date
 */
class m240605_163002_fix_comment_date extends Migration
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

}
