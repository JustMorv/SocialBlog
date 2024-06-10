<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleSeacrh;
use app\models\forms\CommentForm;
use app\models\forms\RegisterForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use yii\web\Controller;
use Symfony\Component\VarDumper\VarDumper;


class SiteController extends Controller

{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
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
        return $this->render('@app/modules/post/views/article/index', [
            'searchModel' => $searchModel, 'articles' => $articles,
            'commentForm' => $commentForm, 'pagination' => $pagination,]);
    }

    public function actionSay($message = "hello")
    {
        return $this->render('say', [
            'message' => $message,
        ]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::info('User ' . $model->email . ' logged in successfully.', __METHOD__);
            return $this->goHome();
        } else {
            Yii::error('Failed login attempt for user: ' . $model->email, __METHOD__);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {

                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    /**
     * Displays about page.
     *
     * @return string
     */

    public function actionEntry()
    {
        $model = new EntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            return $this->render('entry-confirm', ['model' => $model]);
        } else {


            return $this->render('entry', ['model' => $model]);
        }
    }

}
