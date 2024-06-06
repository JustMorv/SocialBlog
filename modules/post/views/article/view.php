<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view shadow-lg pe-5 mb-5 bg-white rounded">
    <div class="container container-title mb-4">
        <p class="text-decoration-none  text-sm font-medium mt-5 pt-5  mb-4 ms-5 ">  <?php foreach ($categories as $category) { ?>
                <?= Html::a($category->title,['/post/article']) ?>
            <?php } ?><span
                    class="mx-2">•</span><?= Html::encode($model->date) ?></p>
        <p class="float-end mt-3">
            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'title' => 'Update']) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'title' => 'Delete',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <h1 class="ms-sm-4 me-sm-3"><?= Html::encode($this->title) ?></h1>

        </p>
    </div>

    <div class="container container-img d-flex align-items-center justify-content-center mt-4 ">
        <?php if (!$articleImage) { ?>
            <div class="container container-img d-flex align-items-center justify-content-center mt-4 ">        <?= Html::img('@web/upload/' . $model->image, ['class' => 'w-50']) ?>
            </div><?php } else { ?>
            <?= \app\widgets\CarouselArticle\CarouselArticle::widget(['data' => $data,]) ?>
        <?php } ?>
    </div>
    <div class="container-content ms-sm-4 me-sm-3 pb-5">
        <div class="description w-100 my-4 align-con">
            <p><?= Html::encode($model->description) ?></p>
        </div>
        <div class="article-content w-95 my-4 ms-sm-1">
            <p><?= Html::decode($model->content) ?></p>
        </div>

        <div class="comments">
            <h2>Комментарии</h2>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><strong><?= Html::encode($comment->user->first_name) ?></strong>
                            <strong><?= Html::encode($comment->user->last_name) ?>:</strong></p>
                        <p><?= Html::encode($comment->text) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Комментариев пока нет.</p>
            <?php endif; ?>
        </div>

        <div class="comment-form">
            <h2>Оставить комментарий</h2>
            <?php $form = ActiveForm::begin([
                'action' => ['article/comment', 'id' => $model->id]
            ]) ?>
            <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control',]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-success ']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>


    </div>