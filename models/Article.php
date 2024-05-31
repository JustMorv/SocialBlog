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
    public $imageFile;

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
            [['description', 'content'], 'string'],
            [['title'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['viewed', 'status', 'user_id', 'category_id'], 'integer'],
            [['title',], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'jpg,png']
        ];
    }


//    public function attributeLabels()
//    {
//        return [
//            'id' => "Номер",
//            'title' => "Заголовок",
//            'description' => "контекст",
//            'content' => 'контент',
//            'date' => 'Дата',
//            'imageFile' => 'картика',
//            'viewed' => 'просмотры',
//            'status' => 'статус',
//            'user_id' => 'привязка юзера',
//            'category_id' => 'привязка категории',
//        ];
//    }

     public function attributeLabels()
     {
         return [
             'id' => Yii::t("app", "ID"),
             'title' => Yii::t("app", "Title"),
             'description' => Yii::t("app", " Description"),
             'content' => Yii::t("app", 'Content'),
             'date' => Yii::t("app", 'Date'),
             'image' => Yii::t("app", 'Image'),
             'viewed' => Yii::t("app", 'Viewed'),
             'status' => Yii::t("app", 'Status'),
             'user_id' => Yii::t("app", 'User ID'),
             'category_id' => Yii::t("app", 'Category ID'),
         ];
     }

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


    public function saveImage($image)
    {
        $this->image = $image;
        return $this->save(false);
    }

    public function upload($image)
    {
        $this->image = $image;
        $path = Yii::getAlias("@web") . 'upload/';
        $this->image = strtolower(md5(uniqid($image->baseName))) . '.' . $image->extension;

        $image->saveAs($path . $this->image);
        $this->save(false);
    }
}
