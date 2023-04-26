<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m230426_073325_create_order
 */
class m230426_073325_create_order extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = '{{%order}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(10)->unsigned(),
            'external_id' => $this->string(16)->null()->defaultValue(null),
            'status_id' => $this->smallInteger(5)->notNull()->unsigned(),
            'status_update_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp()'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp()')
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
