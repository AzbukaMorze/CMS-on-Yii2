<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\PostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'post_category_id') ?>

    <?php  echo $form->field($model, 'status') ?>

    <?php  echo $form->field($model, 'image') ?>

    <?= $form->field($model, 'created_at')->textInput([
        'value' => $model->created_at ? Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i') : '',
    ])->label(Yii::t('app', 'Created At')) ?>

    <?= $form->field($model, 'updated_at')->textInput([
        'value' => $model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i') : '',
    ])->label(Yii::t('app', 'Updated At')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
