<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220404_182326_create_products_table extends Migration
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
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'price' => $this->decimal(),
            'category_id' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

        $this->createIndex('idx-products-name', '{{%products}}', 'name');
        $this->createIndex('idx-products-category_id', '{{%products}}', 'category_id');

        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'categories',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
