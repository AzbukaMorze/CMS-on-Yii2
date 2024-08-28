<?php

namespace common\models;

class PostStatus
{
    const BRAND_NEW = 0;
    const PUBLISHED = 10;
    const REJECTED = 20;

    /**
     * Возвращает список статусов в формате [значение => текст на русском].
     *
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::BRAND_NEW => 'Ожидает внимания',
            self::PUBLISHED => 'Опубликован',
            self::REJECTED => 'Отклонен',
        ];
    }

    /**
     * Возвращает текст статуса по его значению.
     *
     * @param int $status
     * @return string|null
     */
    public static function getStatusText(int $status): ?string
    {
        $statuses = self::getStatusList();
        return $statuses[$status] ?? null;
    }
}