<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery_image}}`.
 */
class m240909_105410_create_gallery_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery_image', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
            'title' => $this->string(),
            'text' => $this->text(),
        ]);

        // Установка внешнего ключа для таблицы gallery_image
        $this->addForeignKey(
            'fk-gallery_image-gallery',
            'gallery_image',
            'gallery_id',
            'gallery',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-gallery_image-gallery',
            'gallery_image'
        );

        // Удаление таблицы gallery_image
        $this->dropTable('gallery_image');
    }
}
