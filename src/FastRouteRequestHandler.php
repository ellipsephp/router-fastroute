<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use FastRoute\Dispatcher;

class FastRouteRequestHandler extends RouterRequestHandler
{
    /**
     * Set up a fast route request handler with the given dispatcher.
     *
     * @param \FastRoute\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        parent::__construct(new FastRouteAdapter($dispatcher));
    }
}
