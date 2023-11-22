<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $status
 * @property int|null $user_id
 * @property int|null $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'content'],    'string'],
            [['title'], 'required'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value'=>date('Y-m-d')],
            [['viewed', 'status', 'user_id', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' =>"Номер",
            'title' =>"Заголовок",
            'description' =>"контекст",
            'content' =>'контент',
            'date' =>'Дата',
            'image' =>'картика',
            'viewed' =>'просмотры',
            'status' =>'статус',
            'user_id' =>'привязка юзера',
            'category_id' =>'привязка категории',
        ];
    }

    // public function attributeLabels()
    // {
    //     return [
    //         'id' => Yii::t("app", "Номер"),
    //         'title' => Yii::t("app", "Заголовок"),
    //         'description' => Yii::t("app", "контекст"),
    //         'content' => Yii::t("app", 'контент'),
    //         'date' => Yii::t("app", 'Дата'),
    //         'image' => Yii::t("app", 'картика'),
    //         'viewed' => Yii::t("app", 'просмотры'),
    //         'status' => Yii::t("app", 'статус'),
    //         'user_id' => Yii::t("app", 'привязка юзера'),
    //         'category_id' => Yii::t("app", 'привязка категории'),
    //     ];
    // }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }
    public function getCategory(){
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
