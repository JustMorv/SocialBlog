<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_comments}}`.
 */
class m231116_085849_create_article_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_comments}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_comments}}');
    }
}
