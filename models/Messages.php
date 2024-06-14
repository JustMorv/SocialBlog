<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $message
 * @property string $created_at
 *
 * @property User $receiver
 * @property User $sender
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'message'], 'required'],
            [['sender_id', 'receiver_id'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Receiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::class, ['id' => 'receiver_id']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'sender_id']);
    }
    public static function getUserChats($userId)
    {
        return self::find()
            ->select(['receiver_id'])
            ->distinct()
            ->where(['sender_id' => $userId])
            ->orWhere(['receiver_id'=>$userId])->all();
    }
}
