<?php

use yii\db\Migration;

/**
 * Class m240618_033737_content_article_category
 */
class m240618_033737_content_article_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $articles = json_decode(file_get_contents(__DIR__ . '/data/article.json'),true, 512,JSON_THROW_ON_ERROR);
        $categoryes = json_decode(file_get_contents(__DIR__ . '/data/category.json'),true, 512,JSON_THROW_ON_ERROR);

        if(!empty($articles)){
            foreach ($articles as $article){
                $this->insert('article',[
                    'title'=>$article['title'],
                    'description'=>$article['description'],
                    'content'=>$article['content'],
                    'date'=>$article['date'],
                    'image'=>$article['image'],
                    'viewed'=>$article['viewed'],
                    'status'=>$article['status'],
                    'user_id'=>$article['user_id'],
                    'category_id'=>$article['category_id'],
                ]);
            }
        }


        if(!empty($categoryes)){
            foreach ($categoryes as $category){
                $this->insert('category',[
                    'title'=>$category['title'],
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240618_033737_content_article_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240618_033737_content_article_category cannot be reverted.\n";

        return false;
    }
    */
}
