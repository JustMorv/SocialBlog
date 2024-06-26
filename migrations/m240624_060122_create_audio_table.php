<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%audio}}`.
 */
class m240624_060122_create_audio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%audio}}', [
            'id' => $this->primaryKey(),
            'playlist_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'file_path' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-audio-playlist_id',
            '{{%audio}}',
            'playlist_id',
            '{{%playlist}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%audio}}');
    }
}
