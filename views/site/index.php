<?php
use yii\bootstrap5\Modal;
use app\models\Country;
use Symfony\Component\VarDumper\VarDumper;


/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php 
        Modal::begin([
            'title'=>"site hello",
        ]);
        echo 'say hello';

        Modal::end(); 
    ?>

  
    

</div>
