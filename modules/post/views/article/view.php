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
        <p class=" text-sm font-medium mt-5 pt-5  mb-4 ms-5">SocialBlog<span
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
        <!--        <span>--><?php //=$model->title?><!--</span>-->
        </p>
    </div>

    <div class="container container-img d-flex align-items-center justify-content-center mt-4 ">
        <?= Html::img('@web/upload/' . $model->image, ['class' => 'w-50']) ?>
    </div>
    <div class="container ms-sm-4 me-sm-3 pb-5 ">
        <div class="description w-100 my-4">
            <p><?= Html::encode($model->description) ?></p>
        </div>
        <div class="article-content w-95 my-4 ms-sm-1">
            <p><?= Html::decode($model->content) ?></p>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'action' => ['article/comment', 'id' => $model->id]
    ]) ?>
    <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Добавить'),['class'=>'btn btn-success ']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>