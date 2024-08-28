<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%insert_into_post_category}}`.
 */
class m240827_092917_create_insert_into_post_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Вставка начальных данных в таблицу post_category
        $this->batchInsert('{{%post_category}}', ['name'], [
            ['Technology'],
            ['Science'],
            ['Lifestyle'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление начальных данных из таблицы post_category
        $this->delete('{{%post_category}}', ['name' => ['Technology', 'Science', 'Lifestyle']]);
    }
}
