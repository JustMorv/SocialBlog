<?php

namespace app\commands;

use app\models\Chat;
use app\models\Message;
use Workerman\Connection\TcpConnection;
use Workerman\Worker;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Json;
use function PHPUnit\Framework\isNull;

class ChatController extends Controller
{
    public array $connections = [];

    public function actionRun()
    {
        $worker = new Worker('websocket://SocialBlog:8080');

        $worker->onConnect = [$this, 'onConnect'];

        $worker->onClose = [$this, 'onClose'];

        $worker->onMessage = [$this, 'onMessage'];

        Worker::runAll();
    }

    public function onConnect(TcpConnection $connection)
    {
        $this->connections[$connection->id] = $connection;
    }

    public function onClose(TcpConnection $connection)
    {
        unset($this->connections[$connection->id]);
    }

    /**
     * @throws InvalidConfigException
     */
    public function onMessage(TcpConnection $connection, string $data)
    {

        $payload = json_decode($data, true);
        $this->stdout($payload['method']);


        $data = match ($payload['method']) {
            'getChats' => $this->getChats($connection, $payload),
            'createChat' => $this->createChat($connection, $payload),
            'sendMessage' => $this->sendMessage($connection, $payload),
        };

        $response = [
            'method' => $payload['method'],
            'data' => $data
        ];

        $connection->send(json_encode($response));
    }

    private function getChats(TcpConnection $connection, $payload): array
    {

        return ['chats' => Chat::find()->asArray()->all()];
    }

    private function sendMessage(TcpConnection $connection, $playload)
    {
        $chat_id = $playload['data']['chat_id'];
        $chat = Chat::findOne($chat_id);
        if(isNull($chat)){
            return ["error"=> "chat is null"];
        }

    }

    private function createChat(TcpConnection $connection, $playload)
    {
        $chat = new Chat();
        $chat->name = $playload['data']['name'];
        $chat->create_time = time();
        $chat->save();


        $message = new Message();
        $message->chat_id = $chat->id;
        $message->username = $playload['data']['username'];
        $message->text = $playload['data']['text'];
        $message->create_time = time();
        $message->save();


        return ['message' => $message->toArray()];


    }
}