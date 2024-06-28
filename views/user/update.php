<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html; ?>
<?=Yii::t('app', 'Редактировать')?>

<h1><?= Yii::t('app', 'Редактировать') ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'first_name')->textInput() ?>
<?= $form->field($model, 'last_name')->textInput() ?>
<?= $form->field($model, 'patronymic')->textInput() ?>
<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>

<div class="container bg-white">
    <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>
