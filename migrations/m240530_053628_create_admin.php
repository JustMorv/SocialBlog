<?php

use yii\db\Migration;

/**
 * Class m240530_053628_create_admin
 */
class m240530_053628_create_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'patronymic' => 'patronymic',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Yii::$app->security->generatePasswordHash("211212"),
            'isAdmin' => 1,
            'photo'=> null,
            'authKey' => Yii::$app->security->generateRandomString(),
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
            $this->delete('user',[ 'email' => 'admin@gmail.com']);
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240530_053628_create_admin cannot be reverted.\n";

        return false;
    }
    */
}
