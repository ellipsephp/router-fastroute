<?php declare(strict_types=1);

namespace Ellipse\Router;

class FastRouteRequestHandler extends RouterRequestHandler
{
    /**
     * Set up a fastroute request handler with the given dispatcher factory.
     *
     * @param callable $factory
     */
    public function __construct(callable $factory)
    {
        parent::__construct(new FastRouteAdapterFactory($factory));
    }
}
