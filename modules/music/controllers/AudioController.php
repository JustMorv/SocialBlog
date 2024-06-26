<?php

namespace app\modules\music\controllers;

use app\models\Audio;
use app\models\Playlist;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class AudioController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $playlists = Playlist::find()->all();
        return $this->render('index', ['playlists' => $playlists]);
    }

    public function actionPlay($id)
    {
        $audio = Audio::findOne($id);
        if ($audio) {
            Yii::$app->session->setFlash('currentAudio', $audio);
        }
        return $this->redirect(['index']);
    }

    public function actionCreate()
    {
        $audio = new Audio();
        if ($audio->load(Yii::$app->request->post())) {
            $audio->created_at = date('Y-m-d');
            $audio->audioFile = UploadedFile::getInstance($audio, 'audioFile');
            if ($audio->upload() && $audio->save(false)) {
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
            'model' => $audio,
        ]);
    }

}