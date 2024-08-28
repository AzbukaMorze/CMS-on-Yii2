<?php

use yii\db\Migration;

/**
 * Class m240828_080357_insert_into_user_table
 */
class m240828_080357_insert_into_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', ['username', 'password_hash', 'auth_source', 'auth_key', 'password_reset_token', 'last_login_at', 'created_at', 'updated_at', 'status'], [
            ['user1', '$2y$10$abcdefghijklmnopqrstuvwx.yz0123456789ABCD', 'default', 'auth_key1', 'reset_token1', time(), time(), time(), 10],
            ['user2', '$2y$10$abcdefghijklmnopqrstuvwx.yz0123456789EFGH', 'default', 'auth_key2', 'reset_token2', time(), time(), time(), 10],
            ['user3', '$2y$10$abcdefghijklmnopqrstuvwx.yz0123456789IJKL', 'default', 'auth_key3', 'reset_token3', time(), time(), time(), 10],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => ['user1', 'user2', 'user3']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240828_080357_insert_into_user_table cannot be reverted.\n";

        return false;
    }
    */
}
