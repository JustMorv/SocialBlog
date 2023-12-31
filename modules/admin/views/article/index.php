<?php

use app\models\Article;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArticleSeacrh $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'date',
            //'image',
            //'viewed',
//            'status',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return !$data->status ?
                        '<p class="text-info">Активен</p>' :
                        '<p class="text-success">Завершён</p>';
                },
                'format' => 'raw',

            ],
            //'user_id',
//            'category_id',
            [
                "attribute" => 'category_id',
                'value' => function ($data) {
                    return !$data->category ? "Категория" : $data->category->title;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Article $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
