<?php declare(strict_types=1);

namespace Ellipse\Router\Exceptions;

use TypeError;

use FastRoute\Dispatcher;

use Ellipse\Exceptions\Type;
use Ellipse\Exceptions\Value;

class FastRouteDispatcherTypeException extends TypeError implements RouterAdapterExceptionInterface
{
    public function __construct($value)
    {
        $template = "The value returned by the fastroute dispatcher factory has type %s - %s expected";

        $value = new Value($value);
        $type = new Type(Dispatcher::class);

        $msg = sprintf($template, $value->type(), $type);

        parent::__construct($msg);
    }
}
