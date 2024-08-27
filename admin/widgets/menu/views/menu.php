<?php

use common\models\Post;
use common\models\PostCategory;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

/** @var yii\web\View $this */
/** @var PostCategory[] $categories */
/** @var Post[] $posts */
?>

<?php
NavBar::begin([
    'brandLabel' => 'CMS',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-light bg-light',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        [
            'label' => Yii::t('app', 'Categories'),
            'url' => ['/category/index'],
            'items' => array_map(function($category) {
                return [
                    'label' => $category->name,
                    'url' => ['/category/view', 'id' => $category->id],
                ];
            }, $categories),
        ],
        [
            'label' => Yii::t('app', 'Posts'),
            'url' => ['/post/index'],
            'items' => array_map(function($post) {
                return [
                    'label' => $post->title,
                    'url' => ['/post/view', 'id' => $post->id],
                ];
            }, $posts),
        ],
        // Добавьте другие сущности и их меню, если необходимо
    ],
]);

NavBar::end();
?>
