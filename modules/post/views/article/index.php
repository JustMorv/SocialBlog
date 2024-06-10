<?php

use app\models\Article;
use yii\bootstrap5\LinkPager;
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
    <?php if (Yii::$app->user->identity!=null){ ?>
    <p>
        <?= Html::a('Create Article', ['/post/article/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    --><?php //= GridView::widget([
    //        'dataProvider' => $dataProvider,
    ////        'filterModel' => $searchModel,
    //        'columns' => [
    //
    //            'id',
    //            'title',
    //            'description:ntext',
    //            'content:ntext',
    //            'date',
    //            'image',
    //            //'viewed',
    ////            'status',
    //            [
    //                'attribute' => 'status',
    //                'value' => function ($data) {
    //                    return !$data->status ?
    //                        '<p class="text-info">Активен</p>' :
    //                        '<p class="text-success">Завершён</p>';
    //                },
    //                'format' => 'raw',
    //
    //            ],
    //            //'user_id',
    ////            'category_id',
    //            [
    //                "attribute" => 'category_id',
    //                'value' => function ($data) {
    //                    return !$data->category ? "Категория" : $data->category->title;
    //                },
    //            ],
    //            [
    //                'class' => ActionColumn::className(),
    //                'urlCreator' => function ($action, Article $model, $key, $index, $column) {
    //                    return Url::toRoute([$action, 'id' => $model->id]);
    //                }
    //            ],
    //        ],
    //    ]); ?>



    <div class="container-articles">
        <div class="card-list">
            <?php foreach ($articles as $article): ?>

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
    <div class="col justify-content-center d-flex mb-4">
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>

</div>


</div>
