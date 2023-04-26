<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m230426_092455_create_message_table extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = '{{%message}}';

    /**
     * @const string
     */
    const REF_TABLE = '{{%integrator}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'message' => $this->text()->notNull(),
            'integrator_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('current_timestamp()'),
            'error_at' => $this->timestamp()->defaultValue(null),
            'sent_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->addForeignKey('fk_message_integrator_id', self::TABLE_NAME, 'integrator_id',
            self::REF_TABLE, 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('fk_message_integrator_id', self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
