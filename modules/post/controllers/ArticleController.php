<?php

namespace app\modules\post\controllers;

use app\models\Article;
use app\models\ArticleImage;
use app\models\ArticleSeacrh;
use app\models\Category;
use app\models\CategorySeacrh;
use app\models\Comment;
use app\models\forms\CommentForm;
use app\models\ImageUpload;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $commentForm = new CommentForm();
        $searchModel = new ArticleSeacrh();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'articles' => $articles,
            'commentForm' => $commentForm,
            'pagination' => $pagination,]);
    }

    /**
     * Displays a single Article model.
     * @param int $id Номер
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $commentForm = new CommentForm();
        $comments = Comment::find()
            ->where(['status' => 0])
            ->where(['article_id' => $id])
            ->orderBy(['date' => SORT_DESC])
            ->limit(10)
            ->with('user')
            ->all();
        $categories = Category::find()->where(['id' => $model->category_id])->all();


        $images = [];
        $articleImage = ArticleImage::find()->where(['article_id' => $model->id])->all();
        foreach ($articleImage as $articleImg) {
            $images[] = $articleImg->filename;
        }
        $data = array_merge(array($model->image), $images);


        return $this->render('view', ['model' => $model,
            'commentForm' => $commentForm,
            'comments' => $comments,
            'categories' => $categories,
            'data' => $data,
            'articleImage' => $articleImage,]);
    }

    public
    function actionComment($id)
    {
        $model = new CommentForm();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id)) {
                return $this->redirect(['article/view', 'id' => $id]);
            }
        }
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public
    function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->save() && $model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Номер
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->save() && $model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public
    function actionImage($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Номер
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Номер
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
