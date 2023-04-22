<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entities}}`.
 */
class m230421_180419_create_entities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entities}}', [
            'id' => $this->primaryKey(),
            'title' =>$this->string(255)->notNull(),
        ]);

        // Seed data
        $this->batchInsert('{{%entities}}', ['title'], [
            ['Yandex'],
            ['Vk'],
            ['Ok'],
            ['Twitter'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entities}}');
    }
}
