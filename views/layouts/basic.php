
<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>

</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <div class="container ">
            <nav class="navbar navbar-expand-lg border-white border-dark">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item ">
                                <?=Html::a("header",'/web/',['class' => 'nav-link'])?>
                            </li>
                            <li class="nav-item">
                                <?=Html::a("Allposts",["post/index"],['class' => 'nav-link'])?>
                            </li>
                            <li class="nav-item">
                            <?=Html::a("post",['post/show'],['class' => 'nav-link'])?>
                            </li>
                     
                        </ul>
                    </div>
                </div>
            </nav>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>