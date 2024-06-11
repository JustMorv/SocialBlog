<?php
$this->title = Yii::t('app', 'Сообщениея')
?>


<div class="row">
    <div class="col-4">
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                create chat
            </button>
        </div>
        <div class="list-group mt-2">
            <button class="list-group-item list-group-item-action active">asdasdasdas</button>
            <button class="list-group-item list-group-item-action ">asdasdasdas</button>
            <button class="list-group-item list-group-item-action ">asdasdasdas</button>
            <button class="list-group-item list-group-item-action ">asdasdasdas</button>
            <button class="list-group-item list-group-item-action ">asdasdasdas</button>
            <button class="list-group-item list-group-item-action ">asdasdasdas</button>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Chat title</label>
                    <input type="email" class="form-control" id="new-chat-title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">First Message</label>
                    <textarea class="form-control" id="new-chat-message" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create chat and send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    const connection = new WebSocket('ws://SocialBlog:8080');

    connection.onopen = () => {
        if (!localStorage.key('username')) {
            let username = prompt('enter username');
            localStorage.setItem('username', username);
        }
    }
    connection.onerror = (error) => {
        console.log(`eroor ${error}`);
    }
    connection.onmessage = (e) => {
        console.log(e.data);
    }
    connection.onclose = () => {
        console.log("close");
    }

</script>
