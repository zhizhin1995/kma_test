<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sys_order_status}}`.
 */
class m230426_073941_create_sys_order_status_table extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = '{{%sys_order_status}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp()')
        ], $tableOptions);

        $this->alterColumn(self::TABLE_NAME, 'id', $this->smallInteger(5).' UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
