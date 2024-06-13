<?php

use app\models\User;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="container d-flex">
    <div class="profile-container mt-5 col-3">
        <?= Html::img('@web/upload/' . User::getUserInfo()->photo, ['class' => 'profile-photo']); ?>
        <div class="profile-info">
            <h2><?= User::getUserInfo()->first_name . " " . User::getUserInfo()->last_name ?></h2>
            <p><span class="label">Имя пользователя:</span> <span
                        class="value"><?= User::getUserInfo()->username ?></span>
            </p>
            <p><span class="label">Email:</span> <span class="value"><?= User::getUserInfo()->email ?></span></p>
        </div>
        <?= Html::a(Yii::t('app', 'Редактировать профиль'), Url::to(['/user/update']), ['class' => 'btn btn-lg btn-success btn-rounded', '<span class="glyphicon glyphicon-edit"></span> ' . Yii::t('app', 'Редактировать профиль')]) ?>


    </div>
    <div class="container mt-5">
        <h3 class="h3 alert alert-success"> <?= Yii::t('app', 'Мои посты') ?></h3>
        <?php if (Yii::$app->session->hasFlash('false')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <?php echo Yii::$app->session->getFlash('false'); ?>
            </div>
        <?php } else { ?>

            <div class="container-articles">
                <div class="card-list profile-card-list ">
                    <?php foreach ($posts as $article): ?>

                        <div class="post">
                            <a href="<?= Url::to(['/post/article/view', 'id' => $article->id]) ?>">
                              <div class="article-user-img justify-content-center">
                                  <?= Html::img('@web/upload/' . $article->image, ['alt' => 'Изображение статьи', 'class'=>'m-auto']) ?>
                              </div>
                                <h2><?= Html::encode($article->title) ?></h2>
                                <p class="date">
                                    <?= Yii::$app->formatter->asDate($article->date, 'medium') ?>
                                </p>
                                <p><?= StringHelper::truncate(Html::encode($article->title), 50, '...') ?></p>

                                <div class="card-meta card-meta--views d-flex justify-content-end">
                                   <?= Html::encode($article->viewed) ?> <i class="fa fa-eye"></i>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
