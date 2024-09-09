<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GalleryImage $model */

$this->title = Yii::t('app', 'Create Gallery Image');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
