
<?php

use app\assets\AppAsset;
use yii\bootstrap5\Html;
/** @var Array $data */
?>



<?=Html::beginTag('div',['class'=>'container-fluid customcolor text-center g-0'])?>
    <?=Html::beginTag('div',['class'=>'swiper-container swiper-container-slider bg-dark '])?>
        <?=Html::beginTag('div',['class'=>'swiper-wrapper  '])?>
            <?php foreach ($data as $key => $slide){?>
                    <?=Html::beginTag('div',['class'=>'swiper-slide'])?>
                        <?=Html::beginTag('div',['class'=>'container'])?>
                            <?=Html::beginTag('div',['class'=>'slider__item-content'])?>
                                <?= Html::endTag('div') ?>
                            <?= Html::endTag('div') ?>
                        <?= Html::img( '@web/upload/' . $slide) ?>
                    <?= Html::endTag('div') ?>
                <?php }?>
        <?= Html::endTag('div') ?>
        <!-- pagination -->
        <?=Html::beginTag('div',['class'=>'container '])?>
            <?=Html::beginTag('div',['class'=>'slider__navigation '])?>
                <?=Html::tag('div','slider',['class'=>'swiper-pagination d-flex '])?>
            <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
        <!-- pagination -->
    <?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>

