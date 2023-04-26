<?php

namespace app\components\notifiers;

use yii\base\ErrorException;

/**
 * @class NotifierFactory
 * @package app\components\notifiers
 */
class NotifierFactory
{
    /**
     * @param string $name
     * @return AbstractNotifier
     * @throws ErrorException
     */
    final public static function getIntegrator(string $name): AbstractNotifier
    {
        $className = __NAMESPACE__ . '\\' . $name . '\\' . ucfirst($name) . 'Notifier';

        if (class_exists($className)) {
            return new $className();
        }

        throw new ErrorException("{$name} integrator class could not be found");
    }
}