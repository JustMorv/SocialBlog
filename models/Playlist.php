<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playlist".
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $image
 * @property int|null $status
 * @property int|null $author_id
 *
 * @property Audio[] $audios
 */
class Playlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['status', 'author_id'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'image' => 'Image',
            'status' => 'Status',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Audios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudios()
    {
        return $this->hasMany(Audio::class, ['playlist_id' => 'id']);
    }
}
