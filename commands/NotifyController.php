<?php declare(strict_types=1);

namespace app\commands;

use app\models\Message;
use app\services\console\NotifyService;
use yii\console\Controller;
use Throwable;

/**
 * @class NotifyController
 * @package app\commands
 */
class NotifyController extends Controller
{
    /**
     * php yii notify/send
     *
     * @return void
     */
    public function actionSend(): void
    {
        $messages = Message::getMessagesByStatus(Message::STATUS_WAITING);

        if (!$messages) {
            $this->stdout("No messages to send" . PHP_EOL);
            exit(0);
        }

        $this->stdout("Started notification send" . PHP_EOL);

        $service = new NotifyService($messages, $this);

        try {
            $service->sendNotifications();
        } catch (Throwable $ex) {
            $this->stdout("Error occurred during message send: {$ex->getMessage()}");

            exit(1);
        }


        $this->stdout("Notification send ended" . PHP_EOL);
    }
}
