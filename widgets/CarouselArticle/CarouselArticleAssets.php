<?php

namespace app\widgets\CarouselArticle;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CarouselArticleAssets extends AssetBundle
{
    public $sourcePath = '@app/widgets/CarouselArticle/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/swiper-bundle.min.css',
        'css/main.css'
    ];
    public $js = [
        'js/swiper.min.js',
        'js/main.js'
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}