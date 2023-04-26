<?php declare(strict_types=1);

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%integrator}}".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_active
 *
 * @property Message[] $messages
 */
class Integrator extends \yii\db\ActiveRecord
{
    /**
     * @const int
     */
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%integrator}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return ActiveQuery
     */
    public function getMessages(): ActiveQuery
    {
        return $this->hasMany(Message::class, ['integrator_id' => 'id']);
    }

    /**
     * Get list of active integrators
     *
     * @return array
     */
    public static function getActiveIntegrators(): array
    {
        return self::find()->where(['is_active' => self::STATUS_ACTIVE])->all();
    }
}
