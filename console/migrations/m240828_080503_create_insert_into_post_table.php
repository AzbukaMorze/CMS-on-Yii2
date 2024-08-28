<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%insert_into_post}}`.
 */
class m240828_080503_create_insert_into_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%post}}', ['user_id', 'title', 'text', 'post_category_id', 'status', 'image', 'created_at', 'updated_at'], [
            [1, 'Post 1 Title', 'This is the text for post 1.', 1, 0, 'image1.jpg', time(), time()],
            [2, 'Post 2 Title', 'This is the text for post 2.', 2, 0, 'image2.jpg', time(), time()],
            [3, 'Post 3 Title', 'This is the text for post 3.', 3, 0, 'image3.jpg', time(), time()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%post}}', ['user_id' => [1, 2, 3]]);
    }
}
