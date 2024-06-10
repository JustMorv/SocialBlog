<?php

namespace app\modules\post\controllers;

use Yii;
use app\models\Comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CommentController extends Controller
{
    public function actionBlock($id)
    {
        $model = $this->findModel($id);
        if ($model->comentsBlock()) {
            Yii::$app->session->setFlash('success', 'Комментарий заблокирован.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось заблокировать комментарий.');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUnblock($id)
    {
        $model = $this->findModel($id);
        if ($model->comentsDisBlock()) {
            Yii::$app->session->setFlash('success', 'Комментарий разблокирован.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось разблокировать комментарий.');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Комментарий не найден.');
        }
    }
}

