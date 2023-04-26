<?php

namespace app\services\console;

use app\components\notifiers\NotifierFactory;
use app\models\Message;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\console\Controller;
use Throwable;

/**
 * @class NotifyService
 * @package app\services\console
 */
class NotifyService extends BaseObject
{
    /**
     * @var array $messages
     */
    private array $messages;

    /**
     * @var Controller $console
     */
    private Controller $console;

    /**
     * @param array $messages
     * @param Controller $console
     */
    public function __construct(array $messages, Controller $console)
    {
        $this->console = $console;
        $this->messages = $messages;

        parent::__construct([]);
    }

    /**
     * @return void
     * @throws ErrorException
     */
    public function sendNotifications()
    {
        /** @var Message $message */
        foreach ($this->messages as $message) {
            if (!$message->integrator->is_active) {
                throw new ErrorException("{$message->integrator->name} integrator is not active");
            }

            $notifier = NotifierFactory::getIntegrator($message->integrator->name);

            if ($notifier->send($message->message)) {
                $message->setStatus(Message::STATUS_SENT);

                $this->console->stdout("#{$message->id} successfully sent" . PHP_EOL);
            } else {
                throw new ErrorException("{$message->id} could not be sent");
            }
        }
    }
}