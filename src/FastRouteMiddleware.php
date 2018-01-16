<?php declare(strict_types=1);

namespace Ellipse\Router;

use FastRoute\Dispatcher;

class FastRouteMiddleware extends RouterMiddleware
{
    /**
     * Set up a fast route middleware with the given dispatcher.
     *
     * @param \FastRoute\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        parent::__construct(new FastRouteRequestHandler($dispatcher));
    }
}
