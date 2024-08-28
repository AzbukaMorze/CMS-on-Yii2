<?php

use common\models\Post;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'title',
            'text:ntext',
            [
                'attribute' => 'post_category_id',
                'value' => function ($model) {
                    return $model->getPostCategoryName();
                },
                'filter' => \common\models\PostCategory::find()->select(['name', 'id'])->indexBy('id')->column(), // фильтр в виде выпадающего списка
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \common\models\PostStatus::getStatusText($model->status);
                },
                'filter' => \common\models\PostStatus::getStatusList(),
            ],
            'image',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i');
                },
                'label' => 'Создано',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i');
                },
                'label' => 'Обновлено',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>




</div>
