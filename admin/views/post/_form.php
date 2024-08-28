<?php

use common\models\Post;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Post $model */
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

    <?= $form->field($model, 'post_category_id')->dropDownList(\common\models\PostCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => Yii::t('app', 'Select Category')])->label(Yii::t('app', 'Post Category')) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\PostStatus::getStatusList(),
        ['prompt' => 'Выберите статус'])->label(Yii::t('app', 'Status')) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

<!--    --><?php //= $form->field($model, 'created_at')->textInput([
//        'value' => $model->created_at ? Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i') : '',
//    ])->label(Yii::t('app', 'Created At')) ?>
<!---->
<!--    --><?php //= $form->field($model, 'updated_at')->textInput([
//        'value' => $model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i') : '',
//    ])->label(Yii::t('app', 'Updated At')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
