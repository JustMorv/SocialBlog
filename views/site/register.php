<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'register-form',

            ]); ?>


            <?= $form->field($model, 'username')->textInput(['autofocus' => true])?>
            <?= $form->field($model, 'first_name')->textInput() ?>
            <?= $form->field($model, 'last_name')->textInput() ?>
            <?= $form->field($model, 'patronymic')->textInput() ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'imageFile')->fileInput(['multiple' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
