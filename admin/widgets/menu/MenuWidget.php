<?php

namespace admin\widgets\menu;

use Yii;
use yii\base\Widget;
use yii\bootstrap5\Nav;

class MenuWidget extends Widget
{
    public function run()
    {
        // Составляем ссылки на сущности
        $menuItems = [
            [
                'label' => Yii::t('app', 'Categories'),
                'url' => ['/post-category'], // Ссылка на страницу со списком категорий
            ],
            [
                'label' => Yii::t('app', 'Posts'),
                'url' => ['/post/index'], // Ссылка на страницу со списком постов
            ],
        ];

        // Возвращаем виджет навигации с одним выпадающим меню
        return Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                [
                    'label' => Yii::t('app', 'Entities'),
                    'items' => $menuItems,
                ]
            ],
        ]);
    }
}
