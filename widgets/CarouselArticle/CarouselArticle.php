<?php

namespace app\widgets\CarouselArticle;

use yii\bootstrap5\Widget;

class CarouselArticle extends Widget
{
    public array $data = [];

    public function run()
    {
        CarouselArticleAssets::register($this->view);
        return $this->render('index', [
            'data' => $this->data,
        ]);
    }
}