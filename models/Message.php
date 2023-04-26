<?php declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $message
 * @property int $integrator_id
 * @property int|null $status
 * @property string $created_at
 * @property string|null $error_at
 * @property string|null $sent_at
 *
 * @property Integrator $integrator
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @const int
     */
    const STATUS_WAITING = 0;

    /**
     * @const int
     */
    const STATUS_SENT = 1;

    /**
     * @const int
     */
    const STATUS_ERROR = 2;

    /**
     * @var string[]
     */
    public static array $statusLabels = [
        self::STATUS_WAITING => 'Waiting',
        self::STATUS_SENT => 'Sent',
        self::STATUS_ERROR => 'error',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['message', 'integrator_id'], 'required'],
            [['message'], 'string'],
            [['integrator_id', 'status'], 'integer'],
            [['created_at', 'error_at', 'sent_at'], 'safe'],
            [['integrator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Integrator::class, 'targetAttribute' => ['integrator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'integrator_name' => 'Integrator Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'error_at' => 'Error At',
            'sent_at' => 'Sent At',
        ];
    }

    /**
     * Gets query for [[Integrator]].
     *
     * @return ActiveQuery
     */
    public function getIntegrator(): ActiveQuery
    {
        return $this->hasOne(Integrator::class, ['id' => 'integrator_id']);
    }

    /**
     * Get messages by status
     *
     * @param int $status
     * @return array
     */
    public static function getMessagesByStatus(int $status): array
    {
        return self::find()->where(['status' => $status])->all();
    }

    /**
     * Set message status and time depends on error or success
     *
     * @param int $status
     * @return void
     * @throws ErrorException
     */
    public function setStatus(int $status): void
    {
        $date = date('Y-m-d H:i:s', time());

        switch ($status) {
            case self::STATUS_ERROR:
                $this->status = self::STATUS_ERROR;
                $this->error_at = $date;
                break;
            case self::STATUS_SENT:
                $this->status = self::STATUS_SENT;
                $this->sent_at = $date;
                break;
            default:
                throw new ErrorException("Invalid message status :{$status}");
        }

        $this->save();
    }
}
