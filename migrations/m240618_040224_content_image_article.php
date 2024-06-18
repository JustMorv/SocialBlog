<?php

use yii\db\Migration;

/**
 * Class m240618_040224_content_image_article
 */
class m240618_040224_content_image_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $articles_images = json_decode(file_get_contents(__DIR__ . '/data/article_image.json'),true, 512,JSON_THROW_ON_ERROR);

        if(!empty($articles_images)){
            foreach ($articles_images as $image){
                $this->insert('article_image',[
                    'article_id'=>$image['article_id'],
                    'filename'=>$image['filename'],
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240618_040224_content_image_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240618_040224_content_image_article cannot be reverted.\n";

        return false;
    }
    */
}
