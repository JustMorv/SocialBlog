<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webchat}}`.
 */
class m240529_031036_create_webchat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255)->notNull(),
            'create_time'=>$this->integer(255)->notNull(),
        ]);
        $this->createTable('message',[
            'id' => $this->primaryKey(),
            'chat_id'=> $this->integer(255)->notNull(),
            'username'=>$this->string(255)->notNull(),
            'text'=> $this->string(255)->notNull(),
            'create_time'=>$this->integer(255)->notNull(),
        ]);
        $this->addForeignKey(
            'fk_message_chat_id',
            'message',
            'chat_id',
            'chat',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
        $this->dropTable('chat');
    }
}
