<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m240827_092741_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'post_category_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'image' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('idx-post-user_id', '{{%post}}', 'user_id');
        $this->createIndex('idx-post-post_category_id', '{{%post}}', 'post_category_id');

        $this->addForeignKey('fk-post-user_id', '{{%post}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-post-post_category_id', '{{%post}}', 'post_category_id', '{{%post_category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey('fk-post-user_id', '{{%post}}');
         $this->dropForeignKey('fk-post-post_category_id', '{{%post}}');
         $this->dropTable('{{%post}}');
    }
}
