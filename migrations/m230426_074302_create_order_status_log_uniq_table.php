<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_status_log_uniq}}`.
 */
class m230426_074302_create_order_status_log_uniq_table extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = '{{%order_status_log_uniq}}';

    /**
     * @const string
     */
    const REF_TABLE_ORDER = '{{%order}}';

    /**
     * @const string
     */
    const REF_TABLE_SYS_ORDER_STATUS = '{{%sys_order_status}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(10)->unsigned(),
            'order_id' => $this->integer(10)->unsigned()->notNull(),
            'status_id' => $this->smallInteger(5)->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp()')
        ]);

        $this->createIndex('uniq', self::TABLE_NAME, ['order_id', 'status_id'], true);

        $this->createIndex('order_id', self::TABLE_NAME, ['order_id']);

        $this->addForeignKey('order_status_log_uniq_ibfk_1', self::TABLE_NAME, 'order_id',
            self::REF_TABLE_ORDER, 'id', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('order_status_log_uniq_ibfk_2', self::TABLE_NAME, 'status_id',
            self::REF_TABLE_SYS_ORDER_STATUS, 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('order_status_log_uniq_ibfk_1', self::TABLE_NAME);
        $this->dropForeignKey('order_status_log_uniq_ibfk_2', self::TABLE_NAME);

        $this->dropIndex('uniq', self::TABLE_NAME);
        $this->dropIndex('order_id', self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
