<?php

use app\models\User;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">
 <div class="article-title d-flex flex-row">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mt-2']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger mt-2',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
 </div>
    <div class="container  parent-container d-flex align-items-center justify-content-center">
    <?=Html::img('@web/upload/' . $model->image, ['class'=>'w-50'] ) ?>
    </div>0
<!--    <h3>--><?php //=Html::encode($model->description, ['class'=>'w-100'] )?><!--</h3>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'date',
            'viewed',
            'status',
            'user_id',
            'category_id',
        ],
    ]) ?>
<!--    --><?php //=\yii\helpers\VarDumper::dump(User::getUserInfo(), 10, 1)?>
<


</div>
