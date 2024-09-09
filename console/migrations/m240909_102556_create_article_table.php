<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text}}`.
 */
class m240909_102556_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы article
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull()->unique(),
            'group' => $this->string()->notNull(),
            'article' => $this->text()->notNull(),
            'comment' => $this->string(),
            'deletable' => $this->boolean()->notNull()->defaultValue(true),
        ]);

        // Вставка неизменяемых текстов
        $this->batchInsert('article', ['key', 'group', 'article', 'comment', 'deletable'], [
            ['main_address', 'contacts', 'Основной адрес', '', false],
            ['main_phone', 'contacts', 'Основной телефон', '', false],
            ['sales_office_address', 'contacts', 'Офис продаж. Адрес', '', false],
            ['sales_office_phone', 'contacts', 'Офис продаж. Телефон', '', false],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление таблицы article
        $this->dropTable('article');
    }
}
