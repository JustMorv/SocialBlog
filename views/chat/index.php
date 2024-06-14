<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;


$this->title = Yii::t('app', 'Сообщения');
?>

<div class="row">
    <div class="col-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-12">
        <?php $form = ActiveForm::begin(['action' => ['send'], 'options' => ['id' => 'message-form']]); ?>
        <?= $form->field($messageModel, 'receiver_id')->dropDownList(ArrayHelper::map($users, 'id', 'email'), [
            'prompt' => 'Выберите пользователя',
            'onchange' => '
                $.pjax.reload({
                    container: "#chat-container",
                    type: "GET",
                    url: "' . \yii\helpers\Url::to(['index']) . '",
                    data: {receiver_id: $(this).val()}
                });
            ',
        ]) ?>
    </div>
    <div class="col-4">
        <h2>Ваши чаты</h2>
        <div class="list-group mt-2">
            <?php foreach ($userChats as $chat): ?>
                <a href="<?= \yii\helpers\Url::to(['index', 'receiver_id' => $chat->receiver_id]) ?>"
                   class="list-group-item list-group-item-action <?= $receiver_id == $chat->receiver_id ? 'active' : '' ?>">
                    <?= Html::encode($chat->receiver->email) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-8">
        <h2>Сообщения</h2>
        <div id="chat-container">
            <?php \yii\widgets\Pjax::begin(); ?>
            <?php if (!empty($messages)): ?>
                <ul class="list-group" id="message-list">
                    <?php foreach ($messages as $message): ?>
                        <li class="list-group-item">
                            <strong><?= Html::encode($message->sender->email) ?>:</strong>
                            <?= Html::encode($message->message) ?>
                            <small class="text-muted float-end"><?= Html::encode($message->created_at) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Выберите пользователя, чтобы начать чат.</p>
            <?php endif; ?>
            <?= $form->field($messageModel, 'message')->textarea(['rows' => 3])->label(false) ?>
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    $(document).ready(function() {
        var lastMessageId = 0; // Store the ID of the last received message

        function fetchNewMessages() {
            $.ajax({
                url: '/chat/fetch-new-messages', // Replace with your actual URL
                data: { last_message_id: lastMessageId },
                success: function(data) {
                    if (data.length > 0) {
                        // Update the chat window with new messages
                        var messageList = $('#message-list');
                        for (var i = 0; i < data.length; i++) {
                            var message = data[i];
                            // Create HTML elements for new messages
                            var messageItem = $('<li class="list-group-item"></li>');
                            messageItem.append('<strong>' + message.sender_email + ':</strong> ');
                            messageItem.append(message.message);
                            messageItem.append('<small class="text-muted float-end">' + message.created_at + '</small>');
                            messageList.append(messageItem);
                            lastMessageId = message.id; // Update last message ID
                        }
                    }
                }
            });
        }

        fetchNewMessages(); // Call initially
        setInterval(fetchNewMessages, 5000); // Check for new messages every 5 seconds
    });
</script>