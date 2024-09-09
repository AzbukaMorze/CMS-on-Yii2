<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m240909_101036_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('room', [
            'id' => $this->primaryKey(),
            'apartment_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'area' => $this->decimal(10, 2)->notNull(),
            'uid' => $this->string()->notNull(),
            'additional_image' => $this->string(),
            'availability' => $this->boolean()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-room-apartment',
            'room',
            'apartment_id',
            'apartment',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-room-apartment', 'room');
        $this->dropTable('room');
    }
}
