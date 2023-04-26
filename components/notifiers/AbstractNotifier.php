<?php

namespace app\components\notifiers;

/**
 * @class AbstractNotifier
 * @package app\components\notifiers
 */
abstract class AbstractNotifier
{
    /**
     * @param string $message
     * @return bool
     */
    final public function send(string $message): bool
    {
        return true;
    }
}