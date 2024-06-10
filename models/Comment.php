<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $user_id
 * @property int|null $article_id
 * @property int|null $status
 *
 * @property Article $article
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */


    const STATUS_OK = 0;
    const STATUS_BLOCKED = 1;

    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status'], 'integer'],
            [['text'], 'string'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' =>Yii::t("app", 'ID'),
            'text' => Yii::t("app",'Text'),
            'user_id' => Yii::t("app",'User ID'),
            'article_id' => Yii::t("app",'Article ID'),
            'status' => Yii::t("app",'Status'),
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function isAllowed()
    {
        return $this->status;
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public function comentsBlock()
    {
        $this->status = self::STATUS_BLOCKED;
        return $this->save(false);
    }

    public function comentsDisBlock()
    {
        $this->status = self::STATUS_OK;
        return $this->save(false);
    }

}
