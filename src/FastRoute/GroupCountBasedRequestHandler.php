<?php declare(strict_types=1);

namespace Ellipse\Router\FastRoute;

use Ellipse\Router\FastRouteRequestHandler;

class GroupCountBasedRequestHandler extends FastRouteRequestHandler
{
    /**
     * Set up a fastroute request handler using a group count based dispatcher
     * mapped with the given mapper.
     *
     * @param callable $mapper
     */
    public function __construct(callable $mapper)
    {
        parent::__construct(new SimpleDispatcher($mapper));
    }
}
