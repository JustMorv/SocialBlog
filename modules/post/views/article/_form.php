<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Article $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'allowedContent' => true,
        ]
    ]) ?>

<!--    --><?php //= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true]) ?>

<!--    --><?php //= $form->field($model, 'viewed')->textInput() ?>

<!--    --><?php //= $form->field($model, 'status')->textInput() ?>

<!--    --><?php //= $form->field($model, 'user_id')->textInput() ?>

    <!--    --><?php //= Html::dropDownList('category', $model->category->id,[])?>

    <?= $form->field($model, 'category_id')->
    dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
