<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%integrator}}`.
 */
class m230426_091847_create_integrator_table extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = '{{%integrator}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(16),
            'is_active' => $this->smallInteger(1)->defaultValue(1),
        ]);

        $this->insert(self::TABLE_NAME, [
            'name' => 'sms',
        ]);

        $this->insert(self::TABLE_NAME, [
            'name' => 'telegram',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
