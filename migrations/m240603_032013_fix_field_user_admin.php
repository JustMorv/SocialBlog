<?php

use yii\db\Migration;

/**
 * Class m240603_032013_fix_field_user_admin
 */
class m240603_032013_fix_field_user_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('{{%user}}', ['photo' => 'no-photo.jpg'], ['id' => 2]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->update('{{%user}}', ['photo' => null], ['id' => 2]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240603_032013_fix_field_user_admin cannot be reverted.\n";

        return false;
    }
    */
}
