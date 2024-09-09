<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appartment}}`.
 */
class m240909_095552_create_appartment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apartment', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull(),
            'floor' => $this->integer()->notNull(),
            'image' => $this->string(),
            'address' => $this->string(),
            'additional_title' => $this->string(),
            'availability' => $this->boolean()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('apartment');
    }
}
