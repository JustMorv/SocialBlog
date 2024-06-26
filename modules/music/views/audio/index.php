
<?php $this->title = 'Плейлисты';
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

?>

<h1><?= Html::encode($this->title) ?></h1>


<?php Pjax::begin(); ?>
<div class="playlists">
    <?php foreach ($playlists as $playlist): ?>
        <div class="playlist">
            <h2><?= Html::encode($playlist->name) ?></h2>
            <ul>
                <?php foreach ($playlist->audios as $audio): ?>
                    <li>
                        <?= Html::encode($audio->title) ?>
                        <?= Html::a('Play', ['play', 'id' => $audio->id], ['class' => 'btn btn-primary', 'data-pjax' => '0']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>
<?php Pjax::end(); ?>



