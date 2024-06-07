<?php

namespace app\controllers;

use app\models\Article;
use app\models\User;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionProfile()
    {
        if(\Yii::$app->user->isGuest){
            return $this->redirect(['site/index']);
        }

        $posts = Article::find()->where(['user_id' => User::getUserInfo()->id])->all();

        if(!$posts){
            Yii::$app->session->setFlash('false', 'Вы не сделали ни одного поста');
        }

        return $this->render('profile',[
            'posts'=>$posts

        ]);
    }

}