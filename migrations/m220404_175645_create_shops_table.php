<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shops}}`.
 */
class m220404_175645_create_shops_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%shops}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(256)->notNull(),
            'last_name' => $this->string(256)->notNull(),
            'phone' => $this->string(12),
            'photo' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

        $this->createIndex('idx-shops-first_name', '{{%shops}}', 'first_name');
        $this->createIndex('idx-shops-last_name', '{{%shops}}', 'last_name');
        $this->createIndex('idx-shops-phone', '{{%shops}}', 'phone');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shops}}');
    }
}
