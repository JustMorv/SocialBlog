<?php

namespace app\controllers;

use app\models\Messages;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class ChatController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($receiver_id = null)
    {
        $users = User::find()->all();
        $userChats = Messages::getUserChats(Yii::$app->user->id);

        $messageModel = new Messages();
        $messageModel->receiver_id = $receiver_id; // Устанавливаем receiver_id при выборе чата слева

        if ($receiver_id !== null) {
            $messages = Messages::find()
                ->where(['sender_id' => Yii::$app->user->id, 'receiver_id' => $receiver_id])
                ->orWhere(['sender_id' => $receiver_id, 'receiver_id' => Yii::$app->user->id])
                ->orderBy(['created_at' => SORT_ASC])
                ->all();
        } else {
            $messages = [];
        }

        return $this->render('index', [
            'users' => $users,
            'userChats' => $userChats,
            'messageModel' => $messageModel,
            'messages' => $messages,
            'receiver_id' => $receiver_id,
        ]);
    }

    public function actionSend()
    {
        $message = new Messages();
        if ($message->load(Yii::$app->request->post())) {
            $message->sender_id = Yii::$app->user->id;
            $message->created_at = date('Y-m-d H:i:s');
            if ($message->save()) {
                return $this->redirect(['index', 'receiver_id' => $message->receiver_id]);
            }
        }
        return $this->redirect(['index']);
    }

    public function actionFetchNewMessages()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $lastMessageId = Yii::$app->request->get('last_message_id');

        $newMessages = Messages::find()
            ->where(['>', 'id', $lastMessageId])
            ->andWhere([
                'or',
                ['sender_id' => Yii::$app->user->id],
                ['receiver_id' => Yii::$app->user->id],
            ])
            ->orderBy('created_at')
            ->all();

        $data = [];
        foreach ($newMessages as $message) {
            $data[] = [
                'id' => $message->id,
                'sender_email' => $message->sender->email,
                'message' => $message->message,
                'created_at' => $message->created_at,
            ];
        }

        return $data;
    }
}
