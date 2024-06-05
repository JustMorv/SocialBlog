<?php

use yii\db\Migration;

/**
 * Class m240604_045756_article_image
 */
class m240604_045756_article_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_image', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'filename' => $this->string()->notNull(),
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_image-article_id',
            'article_image',
            'article_id'
        );

        // add foreign key for table `article`
        $this->addForeignKey(
            'fk-article_image-article_id',
            'article_image',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-article_image-article_id',
            'article_image'
        );

        $this->dropIndex(
            'idx-article_image-article_id',
            'article_image'
        );

        $this->dropTable('article_image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240604_045756_article_image cannot be reverted.\n";

        return false;
    }
    */
}
