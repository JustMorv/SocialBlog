<?php

use app\models\User;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
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
    </div>
    <div class="container mt-5">
       <h3 class="h3 alert alert-success" > <?= Yii::t('app', 'Мои посты') ?></h3>
        <?php if (Yii::$app->session->hasFlash('false')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <?php echo Yii::$app->session->getFlash('false'); ?>
            </div>
        <?php } else { ?>

            <div class="container-articles">
                <div class="card-list">
                    <?php foreach ($posts as $article): ?>

                        <article class="card">
                            <figure class="card-image m-auto">
                                <?= Html::img('@web/upload/' . $article->image, ['alt' => 'Изображение статьи']) ?>
                            </figure>
                            <div class="card-header">
                                <a href="<?= Url::to(['/post/article/view', 'id' => $article->id]) ?>">
                                    <?= Html::encode($article->title) ?>
                                </a>

                                <button class="icon-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" display="block" id="Heart">
                                        <path d="M7 3C4.239 3 2 5.216 2 7.95c0 2.207.875 7.445 9.488 12.74a.985.985 0 0 0 1.024 0C21.125 15.395 22 10.157 22 7.95 22 5.216 19.761 3 17 3s-5 3-5 3-2.239-3-5-3z"/>
                                    </svg>

                            </div>

                            <div class="card-footer">
                                <div class="card-meta card-meta--views">
                                    <?= Html::encode($article->viewed) ?>
                                </div>
                                <div class="card-meta card-meta--date">
                                    <?= Yii::$app->formatter->asDate($article->date, 'medium') ?>
                                </div>
                            </div>
                            </a>

                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
