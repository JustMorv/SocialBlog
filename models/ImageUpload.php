<?php

namespace app\models;

use yii\base\Model;
use yii;

class ImageUpload extends Model
{
    public $image;

    public function upload($image)
    {
        $path = Yii::getAlias("@web") . 'upload/';
        $fileName = strtolower(md5(uniqid($image->baseName))). "." . $image->extension;
        $image->saveAs($path . $fileName);
        return $fileName ;
    }



}