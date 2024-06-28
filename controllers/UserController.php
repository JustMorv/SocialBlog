<?php

namespace app\controllers;

use app\models\Article;
use app\models\forms\UpdateUserForm;
use app\models\User;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;

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
    public function actionUpdate()
    {
        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $model = new UpdateUserForm();

        $model->attributes = $user->attributes;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->update($user)) {
                Yii::$app->session->setFlash('success', 'Информация успешно обновлена.');
                return $this->redirect(['user/profile']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении информации.');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }
}