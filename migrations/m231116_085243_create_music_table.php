<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%music}}`.
 */
class m231116_085243_create_music_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%music}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'user_id' => $this->integer(),
            'title' => $this->string(),


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%music}}');
    }
}
