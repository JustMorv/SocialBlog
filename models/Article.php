<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

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
    public $imageFiles;

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
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['status'], 'default', 'value' => 1],
            [['viewed'], 'default', 'value' => 0],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['viewed', 'status', 'user_id', 'category_id'], 'integer'],
            [['title',], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 10],
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
            'id' => Yii::t("app", "Номер"),
            'title' => Yii::t("app", "Заголовок"),
            'description' => Yii::t("app", "контекст"),
            'content' => Yii::t("app", 'контент'),
            'date' => Yii::t("app", 'Дата'),
            'image' => Yii::t("app", 'картика'),
            'viewed' => Yii::t("app", 'просмотры'),
            'status' => Yii::t("app", 'статус'),
            'user_id' => Yii::t("app", 'привязка юзера'),
            'category_id' => Yii::t("app", 'привязка категории'),
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

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getArticleComments()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }

    public function getAuthorComment()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }


    public function upload()
    {
        if ($this->validate()) {
            $files = $this->imageFiles;
            if (!empty($files)) {
                // Обработка первого файла
                $firstFile = array_shift($files);
                $path = Yii::getAlias("@webroot") . '/upload/';
                $filename = strtolower(md5(uniqid($firstFile->baseName))) . '.' . $firstFile->extension;
                if ($firstFile->saveAs($path . $filename)) {
                    $this->image = $filename; // Сохранение первого файла в поле image
                    $this->save(false);
                }

                // Обработка остальных файлов
                foreach ($files as $file) {
                    $filename = strtolower(md5(uniqid($file->baseName))) . '.' . $file->extension;
                    if ($file->saveAs($path . $filename)) {
                        // Сохранение информации о каждом файле в базе данных
                        $articleImage = new ArticleImage();
                        $articleImage->article_id = $this->id;
                        $articleImage->filename = $filename;
                        $articleImage->save(false);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
