<?php

namespace app\controllers;

use yii\helpers\VarDumper;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionProfile()
    {
        if(\Yii::$app->user->isGuest){
            return $this->redirect(['site/index']);
        }

        return $this->render('profile',[

        ]);
    }

}