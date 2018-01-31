<?php declare(strict_types=1);

namespace Ellipse\Router\Exceptions;

use TypeError;

use FastRoute\Dispatcher;

class FastRouteDispatcherTypeException extends TypeError implements RouterAdapterExceptionInterface
{
    public function __construct($value)
    {
        $template = "The fastroute dispatcher factory returned a value of type %s - object implementing %s expected";

        $type = is_object($value) ? get_class($value) : gettype($value);

        $msg = sprintf($template, $type, Dispatcher::class);

        parent::__construct($msg);
    }
}
