<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->label(Yii::t('app', 'User ID')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label(Yii::t('app', 'Title')) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'basic', // или 'full', 'standard' в зависимости от ваших нужд
            'inline' => false, // режим "inline" по умолчанию false
        ],
    ])->label(Yii::t('app', 'Text')) ?>

    <?= $form->field($model, 'post_category_id')->textInput()->label(Yii::t('app', 'Post Category ID')) ?>

    <?= $form->field($model, 'status')->textInput()->label(Yii::t('app', 'Status')) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true])->label(Yii::t('app', 'Image')) ?>

    <?= $form->field($model, 'created_at')->textInput()->label(Yii::t('app', 'Created At')) ?>

    <?= $form->field($model, 'updated_at')->textInput()->label(Yii::t('app', 'Updated At')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
