<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audio".
 *
 * @property int $id
 * @property int $playlist_id
 * @property string $title
 * @property string $file_path
 * @property string|null $created_at
 *
 * @property Playlist $playlist
 */
class Audio extends \yii\db\ActiveRecord
{
    public $audioFile;

    public static function tableName()
    {
        return 'audio';
    }

    public function rules()
    {
        return [
            [['playlist_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['audioFile'], 'file', 'extensions' => 'mp3, wav'],
            [['playlist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Playlist::class, 'targetAttribute' => ['playlist_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'playlist_id' => Yii::t('app', 'Номер плейлиста'),
            'title' => Yii::t('app', 'название'),
            'audioFile' => Yii::t('app', 'Загруска музыки'),
        ];
    }

    public function getPlaylist()
    {
        return $this->hasOne(Playlist::class, ['id' => 'playlist_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->audioFile) {
                $path = Yii::getAlias("@webroot") . '/upload/';
                $filename = strtolower(md5(uniqid($this->audioFile->baseName))) . '.' . $this->audioFile->extension;
                if ($this->audioFile->saveAs($path . $filename)) {
                    $this->file_path = $filename; // Сохранение имени файла в поле file_path
                    return true;
                }
            }
        }
        return false;
    }
}