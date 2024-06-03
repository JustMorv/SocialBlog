<?php

namespace app\modules\post\controllers;

use app\models\Article;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $asd = Article::find()->all();
        return $this->render('index',['asd' => $asd]);
    }
}
