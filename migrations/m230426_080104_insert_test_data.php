<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m230426_080104_insert_test_data
 */
class m230426_080104_insert_test_data extends Migration
{
    /**
     * @const string
     */
    const TABLE_ORDER = '{{%order}}';

    /**
     * @const string
     */
    const TABLE_STATUS = '{{%sys_order_status}}';

    /**
     * @const string
     */
    const TABLE_STATUS_LOG = '{{%order_status_log_uniq}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->insert(self::TABLE_STATUS, [
            'title' => 'New'
        ]);

        $this->insert(self::TABLE_STATUS, [
            'title' => 'In progress'
        ]);

        $this->insert(self::TABLE_STATUS, [
            'title' => 'Done'
        ]);

        $this->insert(self::TABLE_ORDER, [
            'external_id' => 'm53z7DSEgUawaBQQ',
            'status_id' => 1,
        ]);

        $this->insert(self::TABLE_ORDER, [
            'external_id' => 'Mqsdu6YxbYVSijiG',
            'status_id' => 2,
        ]);

        $this->insert(self::TABLE_ORDER, [
            'external_id' => 'ylaidxWRg0xysFzX',
            'status_id' => 3,
        ]);


        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 1,
            'status_id' => 1,
        ]);

        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 2,
            'status_id' => 1,
        ]);

        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 2,
            'status_id' => 2,
        ]);

        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 3,
            'status_id' => 1,
            'created_at' => date('Y-m-d H:i:s', 1682496550),
        ]);

        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 3,
            'status_id' => 2,
            'created_at' => date('Y-m-d H:i:s', 1682496660),
        ]);

        $this->insert(self::TABLE_STATUS_LOG, [
            'order_id' => 3,
            'status_id' => 3,
            'created_at' => date('Y-m-d H:i:s', 1682496750),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->truncateTable(self::TABLE_ORDER);
        $this->truncateTable(self::TABLE_STATUS);
        $this->truncateTable(self::TABLE_STATUS_LOG);
    }
}
