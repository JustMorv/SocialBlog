<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%playlist}}`.
 */
class m240624_060051_create_playlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%playlist}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string()->defaultValue("no-playlist.png"),
            'status' => $this->integer()->defaultValue(0),
            'author_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%playlist}}');
    }
}
