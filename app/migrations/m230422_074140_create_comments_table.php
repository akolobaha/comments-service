<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m230422_074140_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->defaultValue(null),
            'comment' => $this->text()->notNull(),
            'entity_id' => $this->integer(11)->notNull(),
            'ip' => $this->string(255),
            'user_agent' => $this->string(255),
            'status' => $this->tinyInteger()->check("status >= 0 AND status <= 2"),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk-comments-entities_id-entity-id',
            'comments',
            'entity_id',
            'entities',
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
        $this->dropForeignKey('fk-comments-entities_id-entity-id',
            '{{%comments}}'
        );

        $this->dropTable('{{%comments}}');
    }
}
