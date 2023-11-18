<?php 	
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use Symfony\Component\VarDumper\VarDumper

?>
<?php 	$form =  ActiveForm::begin(); ?>

<?=$form->field($model, "name")->label("123");?>
<?=$form->field($model, "email")->label("email");?>
<?=$form->field($model, "age")->label("age");?>
<?=$form->field($model, "adress")->label("adress");?>
<div class="form-group">	
		<?=Html::submitButton("enter", ['class'=> 'btn btn-primary'])?>
</div>	

<?php 	ActiveForm::end(); ?>

<?=VarDumper::dump(Yii::$app->db	);
 ?>
