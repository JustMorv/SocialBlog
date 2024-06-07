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
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <?php $this->head() ?>
</head>




<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header " class="header">
    <div class="logo-details">
        <div class="logo-section d-flex align-items-center">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <span class="logo_name">Social Blog</span>
        </div>
        <div class="login  d-flex align-items-center">
            <?php if (Yii::$app->user->isGuest) { ?>
                <?= Html::a('Войти', Url::to(['/site/login']), ['class' => 'text-white ']) ?>
                <i class="fa fa-user" style="width: 10px"></i>
            <?php } else { ?>
                <div class="avatar-container ">
                    <?= Html::img('@web/upload/' . User::getUserInfo()->photo, ['class' => 'avatar', 'onclick' => 'toggleDropdown()']) ?>
                    <div class="dropdown">
                        <?= Html::a(Yii::t('app', 'Профиль'), Url::to(['user/profile']), ['']) ?>
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
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                            Group Hub Forums
                        </span>
                </a>
            </li>
<!--            <li class="has-subnav">-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-camera-retro fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                            Survey Photos-->
<!--                        </span>-->
<!--                </a>-->
<!---->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-film fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                            Surveying Tutorials-->
<!--                        </span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-book fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                           Surveying Jobs-->
<!--                        </span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-cogs fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                            Tools & Resources-->
<!--                        </span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-map-marker fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                            Member Map-->
<!--                        </span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-info fa-2x"></i>-->
<!--                    <span class="nav-text">-->
<!--                            Documentation-->
<!--                        </span>-->
<!--                </a>-->
<!--            </li>-->
        </ul>

    </nav>


    <div class="container pb-5" >
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
