<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%docs}}`.
 */
class m240909_102633_create_docs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('document', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull()->unique(),
            'file' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document}}');
    }
}
