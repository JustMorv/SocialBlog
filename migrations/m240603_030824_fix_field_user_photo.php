<?php

use yii\db\Migration;

/**
 * Class m240603_030824_fix_field_user_photo
 */
class m240603_030824_fix_field_user_photo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'photo', $this->string()->defaultValue('no-photo.jpg'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'photo', $this->string()->defaultValue(null));

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240603_030824_fix_field_user_photo cannot be reverted.\n";

        return false;
    }
    */
}
