<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m240613_043015_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->integer()->notNull(),
            'receiver_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Create indexes for sender_id and receiver_id
        $this->createIndex(
            'idx-messages-sender_id',
            '{{%messages}}',
            'sender_id'
        );

        $this->createIndex(
            'idx-messages-receiver_id',
            '{{%messages}}',
            'receiver_id'
        );

        // Add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-sender_id',
            '{{%messages}}',
            'sender_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-messages-receiver_id',
            '{{%messages}}',
            'receiver_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // Drop foreign keys
        $this->dropForeignKey(
            'fk-messages-sender_id',
            '{{%messages}}'
        );

        $this->dropForeignKey(
            'fk-messages-receiver_id',
            '{{%messages}}'
        );

        // Drop indexes
        $this->dropIndex(
            'idx-messages-sender_id',
            '{{%messages}}'
        );

        $this->dropIndex(
            'idx-messages-receiver_id',
            '{{%messages}}'
        );

        // Drop table
        $this->dropTable('{{%messages}}');
    }
}
