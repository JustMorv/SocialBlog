<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$currentAudio = Yii::$app->session->getFlash('currentAudio');
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <?php $this->head() ?>
</head>


<?=\yii\helpers\VarDumper::dump($currentAudio)?>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header " class="header">
    <div class="logo-details">
        <div class="logo-section d-flex align-items-center">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <span class="logo_name">Social Blog</span>
        </div>
        <div>
            <?php if ($currentAudio): ?>
                <div class="audio-player">
                    <audio controls autoplay>
                        <source src="<?= Yii::getAlias('@web/upload/tracks/' . $currentAudio->file_path) ?>"
                                type="audio/mpeg">
                    </audio>
                    <div>
                        <?= Html::encode($currentAudio->title) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="login  d-flex align-items-center">
            <?php if (Yii::$app->user->isGuest) { ?>
                <?= Html::a('Войти', Url::to(['/site/login']), ['class' => 'text-white ']) ?>
                <i class="fa fa-user" style="width: 10px"></i>
            <?php } else { ?>
                <div class="avatar-container ">
                    <?= Html::img('@web/upload/' . User::getUserInfo()->photo, ['class' => 'avatar', 'onclick' => 'toggleDropdown()']) ?>
                    <div class="dropdown">
                        <?= Html::a(Yii::t('app', 'Профиль'), Url::to(['/user/profile']), ['']) ?>
                        <?= Html::a(Yii::t('app', 'Редактировать профиль'), Url::to(['user/upate']), ['']) ?>
                        <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            Yii::t('app', 'Выход'),
                            ['class' => 'btn btn-link text-dark']
                        )
                        . Html::endForm()
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</header>

<div class="container-fluid  ">
    <nav class="main-menu h-100 position-fixed ">
        <ul>
            <?php if (Yii::$app->user->identity) { ?>
                <li class="has-subnav">
                    <a href="<?= Url::to(['/user/profile']) ?>">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="nav-text"><?= Yii::t('app', 'моя страница') ?></span>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="<?= Url::to(['/site/index']) ?>">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text"><?= Yii::t('app', 'Главная') ?></span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="<?= Url::to(['/post/article']) ?>">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text"><?= Yii::t('app', 'Статьи') ?></span>
                </a>
            </li>
            <?php if (Yii::$app->user->identity) { ?>
                <li class="has-subnav">
                    <a href="<?= Url::to(['/chat/index']) ?>">
                        <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text"><?= Yii::t('app', 'Сообщения') ?></span>
                    </a>
                </li>
            <?php } ?>


            <li class="has-subnav">
                <a href="<?= Url::to(['/music/audio/index']) ?>">
                    <i class="fa fa-music fa-2x"></i>
                    <span class="nav-text"><?= Yii::t('app', 'Музыка') ?></span>
                </a>
            </li>

        </ul>

    </nav>
    <?php \yii\widgets\Pjax::begin() ?>
    <div class="container pb-5 bg-light">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <div class="" style="margin-left: 40px">
                <?= Html::tag('i', '', ['class' => 'nav-icon fa fa-home fa-2x fa-breadcrumbs ']) . Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            </div>
        <?php endif ?>
        <?= Alert::widget() ?>
        <div class="container mt-3">
            <?php \yii\widgets\Pjax::begin()?>
            <?= $content ?>
            <?php \yii\widgets\Pjax::end() ?>
        </div>
    </div>


</div>




<footer id="footer" class="position-fixed bottom-0 w-100 py-3 bg-light ">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Social Blog <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const audioElement = document.getElementById('audioPlayer');
        if (audioElement) {
            audioElement.play();
        }
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
