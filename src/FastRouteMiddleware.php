<?php declare(strict_types=1);

namespace Ellipse\Router;

class FastRouteMiddleware extends RouterMiddleware
{
    /**
     * Set up a fast route middleware with the given dispatcher factory.
     *
     * @param callable $factory
     */
    public function __construct(callable $factory)
    {
        parent::__construct(new FastRouteRequestHandler($factory));
    }
}
