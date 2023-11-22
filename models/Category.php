<?php

namespace app\models;
use app\models\Article;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
    public function getArticle()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public function getArticlesCount(){
        return $this->getArticle()->count();
    }

    public static function getAll(){
        return Category::find()->all();
    }
    public static function getArticlesByCategory($category_id){
        $query = Article::find()->where(["category_id"=> $category_id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 3]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;


        
    }
}
